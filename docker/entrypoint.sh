#!/bin/sh
set -e

# Save environment variables for cron if running as root
if [ "$(id -u)" = "0" ]; then
  echo "Saving environment variables for cron..."
  env | grep -v -e '^HOME=' -e '^USER=' -e '^PATH=' -e '^SHELL=' > /var/www/.cronenv || true
  chown www-data:www-data /var/www/.cronenv
  chmod 600 /var/www/.cronenv
fi

# Wait for PostgreSQL database if DB_HOST is defined
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database connection at $DB_HOST:${DB_PORT:-5432}..."
  until php -r "
    try {
        new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: '5432') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }
  " >/dev/null 2>&1; do
    sleep 1
  done
  echo "Database is up and running!"
fi

# Create storage symlink if it doesn't exist
if [ ! -e "/var/www/public/storage" ]; then
  echo "Creating storage symlink..."
  php artisan storage:link --relative || php artisan storage:link
fi

# Run migrations if RUN_MIGRATIONS is set to true
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "Running database migrations..."
  php artisan migrate --force
fi

# Cache configuration if APP_ENV is production
if [ "$APP_ENV" = "production" ]; then
  echo "Caching configuration and routes for production..."
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
fi

# Execute the main container command
exec "$@"
