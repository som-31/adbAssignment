cp /home/site/default /etc/nginx/sites-available/default
service nginx reload

cd /home/site && cp .env wwwroot/.env
php artisan key:generate
