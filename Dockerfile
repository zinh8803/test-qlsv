# 1. Sử dụng PHP chính thức + Composer
FROM php:8.2-fpm

# 2. Cài đặt extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 3. Cài Composer (copy từ image composer chính thức)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Tạo user thường (bảo mật hơn root)
RUN useradd -ms /bin/bash app

# 5. Tạo thư mục và phân quyền cho user app
WORKDIR /var/www
COPY . .
RUN composer install --no-dev --optimize-autoloader \
 && chown -R app:app /var/www \
 && chmod -R 775 storage bootstrap/cache \
 && mkdir -p storage/logs \
 && chown -R app:app storage bootstrap/cache

# 6. Copy cấu hình supervisor
COPY ./supervisord.conf /etc/supervisord.conf

# 7. Chạy container bằng user app (không phải root)
USER app

# 8. Mở port (Render sẽ tự map, ta để port 0.0.0.0)
EXPOSE 8000

# 9. CMD khởi động Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
