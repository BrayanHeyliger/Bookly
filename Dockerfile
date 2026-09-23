# Bookly — Docker image so Render can run PHP (it has no native PHP runtime).
#
# Build locally from the repository root:
#   docker build -t bookly .
#   docker run -p 8000:8000 -e PORT=8000 bookly
#
# On Render this is selected by render.yaml (runtime: docker).
#
# PATHS: this file assumes the build context is the REPOSITORY ROOT, which is
# what render.yaml declares (dockerContext: ./). The app itself lives in bookly/.

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

# Copy the build context (repository root: contains bookly/ and public/).
COPY . /app

# Resolve the app root whichever way the context landed:
#   root context     -> /app/bookly
#   bookly/ context  -> /app
RUN APP=/app; \
    if [ -d /app/bookly ]; then APP=/app/bookly; fi; \
    mkdir -p "$APP/storage/ratelimit" "$APP/storage/cache"; \
    chmod -R 775 "$APP/storage"; \
    echo "$APP" > /app/.approot; \
    echo "Resolved app root: $APP"

# Fail loudly at build time if an extension the installer checks for is
# missing, rather than discovering it at runtime behind the requirements screen.
RUN php -m | grep -qx pdo        || (echo "MISSING: pdo" && exit 1)
RUN php -m | grep -qx pdo_sqlite || (echo "MISSING: pdo_sqlite" && exit 1)
RUN php -m | grep -qx mbstring   || (echo "MISSING: mbstring" && exit 1)

EXPOSE 8000

# Render injects $PORT; fall back to 8000 for local docker runs.
CMD ["sh", "-c", "APP=$(cat /app/.approot); DOC=\"$APP/public\"; [ -d \"$DOC\" ] || DOC=\"$APP\"; echo \"Serving $DOC\"; php -S 0.0.0.0:${PORT:-8000} -t \"$DOC\" \"$APP/public/router.php\""]
