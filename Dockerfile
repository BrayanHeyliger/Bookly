# Bookly — Docker image so Render can run PHP (it has no native PHP runtime).
#
# Build locally:
#   docker build -t bookly .
#   docker run -p 8000:8000 -e PORT=8000 bookly
#
# On Render this is selected by render.yaml (runtime: docker).

FROM php:8.3-cli

# Extensions the installer checks for: pdo, pdo_sqlite, mbstring.
# Installed as separate layers so a failed build names the extension that broke.
RUN docker-php-ext-install pdo

RUN docker-php-ext-install pdo_sqlite

RUN apt-get update \
 && apt-get install -y --no-install-recommends libonig-dev \
 && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-install mbstring

WORKDIR /app

# The whole repository; the app itself lives in bookly/.
COPY . /app

# storage/ must stay writable for the SQLite database and rate-limiter buckets.
RUN mkdir -p /app/bookly/storage/ratelimit /app/bookly/storage/cache \
 && chmod -R 775 /app/bookly/storage

EXPOSE 8000

# Render injects $PORT; fall back to 8000 for local docker runs.
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8000} -t /app/bookly/public /app/public/router.php"]
