cd krsku

apt-get update -y
apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd
docker-php-ext-install mysqli pdo pdo_mysql exif pcntl bcmath zip

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

composer install
composer dump-autoload
php artisan migrate
php artisan serve --host=0.0.0.0 --port=3333
