# Production Deployment Guide: Deploying `zen-backend` on DigitalOcean Ubuntu Droplet

This guide details the exact step-by-step process for deploying the `zen-backend` application from scratch onto a fresh, clean Ubuntu Droplet on the DigitalOcean platform.

This application is built with:
- **PHP 8.3-FPM** with compiled Redis, PDO, and standard extensions.
- **Nginx Web Server** proxying HTTP requests to the PHP application.
- **PostgreSQL 16** as the persistent database service.
- **Redis 7** acting as the high-performance cache and queue broker.
- **Laravel Queue Worker** processing asynchronous jobs under a restricted `www-data` user.
- **Laravel Scheduler** executing periodic cron tasks.

---

## Deployment Architecture Overview

```mermaid
graph TD
    Client[Client Browser / API Client] -->|HTTPS:443 / HTTP:80| HostNginx[Host Nginx / Certbot SSL]
    HostNginx -->|Reverse Proxy:8000| DockerNginx[Docker Nginx Container: zen-web]
    DockerNginx -->|FastCGI:9000| AppContainer[PHP-FPM Container: zen-app]
    AppContainer -->|Query| DB[Postgres Container: zen-db]
    AppContainer -->|Cache/Queue| Redis[Redis Container: zen-redis]
    QueueWorker[Queue Worker Container: zen-queue-worker] -->|Process| Redis
    Scheduler[Scheduler Container: zen-scheduler] -->|Execute| AppContainer
```

In a production environment, we use a **two-tier Nginx architecture** to ensure robust SSL termination:
1. **Host Nginx**: Binds to ports `80` and `443` directly on the host server, manages SSL certificates via Let's Encrypt Certbot, and reverse proxies traffic to port `8000`.
2. **Docker Nginx (`zen-web`)**: Binds internally on port `8000` to serve static files and forwards PHP requests directly to `zen-app:9000`.

---

## Phase 1: Provisioning and Securing the DigitalOcean Droplet

### 1. Create the Droplet in DigitalOcean
1. Log in to the **DigitalOcean Control Panel**.
2. Click **Create** (top right) -> **Droplets**.
3. **Region**: Choose the data center closest to your users.
4. **Image**: Choose **Ubuntu 24.04 LTS** (or 22.04 LTS).
5. **Size**: Choose **Basic CPU** -> **Regular SSD** or **Premium Intel/AMD** (minimum 1 GB RAM / 1 vCPU is required, 2 GB RAM is recommended for running building processes smoothly).
6. **Authentication**: Select **SSH Keys** (add your public SSH key).
7. Click **Create Droplet**.

### 2. Log In and Update System Packages
Once the Droplet is active, copy its IP address and establish an SSH connection:
```bash
ssh root@your-droplet-ip
```
After connecting, run:
```bash
sudo apt update && sudo apt upgrade -y
```

### 3. Hardening Server Access (UFW Firewall)
To secure the network interfaces of your Droplet, restrict all open ports except those explicitly required for web traffic and administration:
```bash
# Configure default policies
sudo ufw default deny incoming
sudo ufw default allow outgoing

# Allow operational ports
sudo ufw allow 22/tcp    # SSH
sudo ufw allow 80/tcp    # HTTP
sudo ufw allow 443/tcp   # HTTPS

# Enable the firewall rules
sudo ufw enable
```
*Verify UFW status:*
```bash
sudo ufw status verbose
```

---

## Phase 2: Installing Docker & Host Nginx

We will install Docker Engine, Docker Compose, and host Nginx from official upstream repositories.

### 1. Install Docker and Docker Compose
```bash
# Install system pre-requisites
sudo apt-get install -y ca-certificates curl gnupg

# Add Docker's official GPG key
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

# Register official repository
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

sudo apt-get update

# Install Docker packages
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

### 2. Install Host Nginx and Certbot (SSL)
```bash
sudo apt install -y nginx certbot python3-certbot-nginx
```

### 3. Verification
Verify that both Docker and Nginx are running smoothly:
```bash
docker --version
docker compose version
sudo systemctl status docker --no-pager
sudo systemctl status nginx --no-pager
```

---

## Phase 3: Code Deployment & Configuration

We will organize the code under `/var/www/zen-backend` and configure our environments.

### 1. Create a Non-Root User (Optional but Highly Recommended)
For safety, avoid running commands as root where possible. Create a dedicated deploy user:
```bash
sudo adduser deploy
sudo usermod -aG sudo,docker deploy
```
*Now, switch to the new user:*
```bash
su - deploy
```

### 2. Set Up the Project Directory
```bash
sudo mkdir -p /var/www/zen-backend
sudo chown -R deploy:deploy /var/www/zen-backend
cd /var/www/zen-backend
```

### 3. Deploy the Repository
Clone your project repository directly into the current folder:
```bash
git clone git@github.com:your-organization/zen-backend.git .
```
*(If you are using private repositories, configure an SSH Deploy Key on GitHub/GitLab first).*

### 4. Configure Production Environment variables
Create the production `.env` file from the repository template:
```bash
cp .env.example .env
nano .env
```

Ensure the following production settings are populated:
```env
APP_NAME=ZenBackend
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=zen_backend
DB_USERNAME=zen_admin
DB_PASSWORD=your_highly_secure_password

REDIS_HOST=redis
REDIS_PORT=6379

QUEUE_CONNECTION=redis
CACHE_STORE=redis
SESSION_DRIVER=redis

# Let Nginx Docker container know to bind on port 8000 internally
FORWARD_HTTP_PORT=8000
FORWARD_DB_PORT=5433
FORWARD_REDIS_PORT=6379

RUN_MIGRATIONS=true
```

---

## Phase 4: Host Nginx Configuration & SSL Setup

Now, we configure host Nginx to accept public traffic on port `80` and `443`, term SSL, and proxy traffic to our Docker web service on port `8000`.

### 1. Create Host Nginx Server Block
Create a new configuration file:
```bash
sudo nano /etc/nginx/sites-available/zen-backend
```

Paste the following configuration (replace `yourdomain.com` with your actual domain):
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;

    # Redirect HTTP traffic to HTTPS (Certbot will handle this automatically, but this is a placeholder)
    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

### 2. Enable Configuration and Test Nginx
```bash
# Link the site configuration to sites-enabled
sudo ln -s /etc/nginx/sites-available/zen-backend /etc/nginx/sites-enabled/

# Remove default configuration if present to avoid port conflicts
sudo rm /etc/nginx/sites-enabled/default

# Test Nginx syntax
sudo nginx -t

# Reload Nginx server
sudo systemctl reload nginx
```

### 3. Generate Let's Encrypt SSL Certificate
Run Certbot to request a secure SSL certificate and configure HTTPS automatically:
```bash
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```
*Follow the interactive prompts. Choose the option to automatically redirect all HTTP traffic to HTTPS.*

---

## Phase 5: Building and Launching the Docker Environment

With the host infrastructure fully configured, build your Docker services.

### 1. Generate Laravel Security Key
Generate the static encryption key used for hashes, cookies, and tokens:
```bash
# Since we are using Docker, run this inside the container context once
docker compose run --rm app php artisan key:generate
```
Copy the generated key from output and ensure it is updated inside your host `.env` file if it was not auto-saved.

### 2. Launch the Application Suite
Build the customized PHP image (installing the Redis extension, setting up `www-data` shell, creating the scheduler crontab) and launch all containers in detached mode:
```bash
docker compose up --build -d
```

---

## Phase 6: Post-Deployment Verification

Verify that all systems are operational:

### 1. Verify Container States
Check the health status of all six services:
```bash
docker compose ps
```
Your output should resemble:
```text
NAME                IMAGE               COMMAND                  SERVICE             CREATED             STATUS              PORTS
zen-app             zen-backend-app     "/var/www/docker/en…"   app                 3 minutes ago       Up 3 minutes        9000/tcp
zen-db              postgres:16-alpine  "docker-entrypoint.s…"   db                  3 minutes ago       Up 3 minutes        5432/tcp, 0.0.0.0:5433->5432/tcp
zen-queue-worker    zen-backend-app     "/var/www/docker/en…"   queue-worker        3 minutes ago       Up 3 minutes        9000/tcp
zen-redis           redis:7-alpine      "docker-entrypoint.s…"   redis               3 minutes ago       Up 3 minutes        0.0.0.0:6379->6379/tcp
zen-scheduler       zen-backend-app     "/var/www/docker/en…"   scheduler           3 minutes ago       Up 3 minutes        9000/tcp
zen-web             nginx:alpine        "/docker-entrypoint.…"   web                 3 minutes ago       Up 3 minutes        0.0.0.0:8000->80/tcp
```

### 2. Verify Database Connection and Migrations
Check the startup logs of `zen-app` to ensure the database connectivity check succeeded and migrations ran:
```bash
docker compose logs app
```
You should see:
```text
Waiting for database connection at db:5432...
Database is up and running!
Creating storage symlink...
Running database migrations...
Migration table created successfully.
...
```

### 3. Verify Scheduler Execution
Verify that the `crond` process in the scheduler container is starting scheduled jobs:
```bash
docker compose logs scheduler
```

### 4. Verify Non-Root Execution of Queue Worker
Verify that the queue worker service is running under the secure `www-data` user:
```bash
docker compose exec queue-worker whoami
# Output must be: www-data
```

---

## Phase 7: Regular Maintenance & Housekeeping

### 1. Update Application Code
To deploy new code modifications:
```bash
cd /var/www/zen-backend
git pull origin main
docker compose up --build -d
```

### 2. Automated Cleanups (Weekly Cron Job)
Prevent build caches and orphaned container volumes from consuming Droplet storage.
Add a weekly cron task on your host server:
```bash
sudo crontab -e
```
Add the following line to execute a clean-up every Sunday at 3:00 AM:
```text
0 3 * * 0 docker system prune -af --volumes > /dev/null 2>&1
```

### 3. Check Real-time System Load
To see how much memory and CPU the running containers are taking:
```bash
docker stats
```
