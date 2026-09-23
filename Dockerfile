# Bookly — Docker image so Render can run PHP (it has no native PHP runtime).
#
# Build locally:
#   docker build -t bookly .
#   docker run -p 8000:8000 -e PORT=8000 bookly
#
# On Render this is selected by render.yaml (runtime: docker).

FROM php:8.3-cli

# pdo ships compiled in this image — reinstalling it fails with
# "Cannot find config.m4", so only the SQLite driver is built here.
#
# pdo_sqlite's configure step runs pkg-config for sqlite3 >= 3.7.7, so the
# development headers must be present BEFORE the extension compiles. Without
# libsqlite3-dev the build aborts with:
#   Package requirements (sqlite3 >= 3.7.7) were not met
#
# mbstring needs libonig-dev for the same reason.
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
      libsqlite3-dev \
      libonig-dev \
 && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-install pdo_sqlite \
 && docker-php-ext-install mbstring

WORKDIR /app

# The whole repository; the app itself lives in bookly/.
COPY . /app

# storage/ must stay writable for the SQLite database and rate-limiter buckets.
RUN mkdir -p /app/bookly/storage/ratelimit /app/bookly/storage/cache \
 && chmod -R 775 /app/bookly/storage

# Fail loudly at build time if an extension the installer checks for is
# missing, rather than discovering it at runtime behind the requirements screen.
RUN php -m | grep -qx pdo        || (echo "MISSING: pdo" && exit 1)
RUN php -m | grep -qx pdo_sqlite || (echo "MISSING: pdo_sqlite" && exit 1)
RUN php -m | grep -qx mbstring   || (echo "MISSING: mbstring" && exit 1)

EXPOSE 8000

# Render injects $PORT; fall back to 8000 for local docker runs.
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8000} -t /app/bookly/public /app/public/router.php"]
