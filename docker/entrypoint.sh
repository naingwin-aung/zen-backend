#!/bin/sh
set -e

# Save environment variables for cron if running as root
if [ "$(id -u)" = "0" ]; then
  echo "Saving environment variables for cron..."
  env | grep -v -e '^HOME=' -e '^USER=' -e '^PATH=' -e '^SHELL=' > /var/www/.cronenv || true
  chown www-data:www-data /var/www/.cronenv
  chmod 600 /var/www/.cronenv

  echo "Setting correct permissions for storage and bootstrap/cache..."
  chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
  chmod -R 775 /var/www/storage /var/www/bootstrap/cache
fi

# Wait for PostgreSQL database with a 30s timeout to prevent infinite boot-loops
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database connection at $DB_HOST:${DB_PORT:-5432}..."
  TIMEOUT=30
  COUNTER=0
  until php -r "
    try {
        new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: '5432') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }
  " >/dev/null 2>&1; do
    COUNTER=$((COUNTER + 1))
    if [ $COUNTER -ge $TIMEOUT ]; then
      echo "Error: Database connection timed out after $TIMEOUT seconds!" >&2
      exit 1
    fi
    sleep 1
  done
  echo "Database is up and running!"
fi

# Create storage symlink as www-data to avoid permission issues
if [ ! -e "/var/www/public/storage" ]; then
  echo "Creating storage symlink..."
  su -s /bin/sh -c "php artisan storage:link --relative" www-data || su -s /bin/sh -c "php artisan storage:link" www-data
fi

# Run migrations as www-data if RUN_MIGRATIONS is set to true
if [ "$RUN_MIGRATIONS" = "true" ]; then
  echo "Running database migrations..."
  su -s /bin/sh -c "php artisan migrate --force" www-data
fi

# Cache configuration if APP_ENV is production (runtime fallback)
if [ "$APP_ENV" = "production" ]; then
  echo "Caching configuration and routes for production..."
  su -s /bin/sh -c "php artisan config:cache" www-data
  su -s /bin/sh -c "php artisan route:cache" www-data
  su -s /bin/sh -c "php artisan view:cache" www-data
fi

# Execute the main container command
exec "$@"
