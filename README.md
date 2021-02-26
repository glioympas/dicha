## Install & Run

1) composer update
2) Μετανομασία .env.example σε .env και σωστή ρύθμιση βάσης
3) php artisan config:cache
4) php artisan migrate:fresh --seed
5) php artisan key:generate
6) php artisan config:cache
7) php artisan serve
