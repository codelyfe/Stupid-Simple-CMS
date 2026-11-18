FROM php:8.4-apache

RUN a2enmod rewrite headers deflate expires \
    && { \
        echo "opcache.enable=1"; \
        echo "opcache.enable_cli=0"; \
        echo "opcache.memory_consumption=128"; \
        echo "opcache.interned_strings_buffer=16"; \
        echo "opcache.max_accelerated_files=10000"; \
        echo "opcache.validate_timestamps=1"; \
        echo "opcache.revalidate_freq=2"; \
        echo "opcache.jit=tracing"; \
        echo "opcache.jit_buffer_size=64M"; \
        echo "realpath_cache_size=4096K"; \
        echo "realpath_cache_ttl=600"; \
    } > /usr/local/etc/php/conf.d/opcache-tuning.ini \
    && { \
        echo "ServerTokens Prod"; \
        echo "ServerSignature Off"; \
        echo "<IfModule mod_deflate.c>"; \
        echo "  AddOutputFilterByType DEFLATE text/html text/plain text/css text/javascript application/javascript application/json image/svg+xml"; \
        echo "</IfModule>"; \
        echo "<IfModule mod_expires.c>"; \
        echo "  ExpiresActive On"; \
        echo "  ExpiresByType text/css \"access plus 7 days\""; \
        echo "  ExpiresByType application/javascript \"access plus 7 days\""; \
        echo "  ExpiresByType image/jpeg \"access plus 30 days\""; \
        echo "  ExpiresByType image/png \"access plus 30 days\""; \
        echo "  ExpiresByType image/webp \"access plus 30 days\""; \
        echo "  ExpiresByType image/svg+xml \"access plus 30 days\""; \
        echo "</IfModule>"; \
    } > /etc/apache2/conf-available/performance.conf \
    && a2enconf performance

WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
