FROM php:8.3-cli

# Runtime extensions Bookly needs: PDO + SQLite driver, plus mbstring.
RUN docker-php-ext-install pdo pdo_sqlite \
 && apt-get update \
 && apt-get install -y --no-install-recommends libonig-dev \
 && docker-php-ext-install mbstring \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# The application lives in bookly/ in this repository.
COPY . /app

# storage/ must stay writable for the SQLite database and rate-limiter buckets.
RUN mkdir -p /app/bookly/storage/ratelimit /app/bookly/storage/cache \
 && chmod -R 775 /app/bookly/storage

EXPOSE 8000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8000} -t /app/bookly/public /app/public/router.php"]
