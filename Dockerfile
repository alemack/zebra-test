# Используем официальный PHP-образ
FROM php:8.2-cli

# Рабочая директория внутри контейнера
WORKDIR /var/www/html

# Устанавливаем зависимости
RUN apt-get update && \
    apt-get install -y zip unzip git libzip-dev && \
    docker-php-ext-install pdo_mysql

# Копируем содержимое проекта внутрь контейнера
COPY . .

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Ставим зависимости Laravel
RUN composer install

# Запускаем встроенный сервер Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
