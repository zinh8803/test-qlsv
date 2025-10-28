# Sử dụng PHP chính thức có sẵn composer
FROM php:8.2-fpm

# Cài đặt các extension cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www

# Copy tất cả file vào container
COPY . .

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader

# Cấp quyền cho storage & bootstrap
RUN chmod -R 777 storage bootstrap/cache

# Cài đặt supervisor để quản lý process
RUN apt-get update && apt-get install -y supervisor

# Copy file cấu hình supervisor cho Laravel
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose cổng 10000 (Render đặt biến PORT=10000 cho dịch vụ web Docker)
EXPOSE 10000

# CMD sử dụng supervisor để chạy Laravel
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
