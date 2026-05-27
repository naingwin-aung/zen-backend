#!/bin/sh
set -e

# Wait for PostgreSQL database if DB_HOST is defined
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database connection at $DB_HOST:${DB_PORT:-5432}..."
  until nc -z "$DB_HOST" "${DB_PORT:-5432}"; do
    sleep 1
  done
  echo "Database is up and running!"
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
