# Laravel Basic + Advance
## Configs
### flollowing configs need in your .env 
- Database configurations
- BROADCAST_DRIVER=`pusher`
- Mail Configs : set your keys , generate form <a href="smtp.mailtrap.io" target="_blank">smtp.mailtrap.io</a>
- PUSHER configs :set your keys , get form <a href=" pusher.com" target="_blank"> pusher.com</a>

## Install that it need
- composer install
- npm install

## Clean cache
- php artisan config:cache
- php artisan route:clear
- php artisan view:clear

## Run app
- php artisan migrate
- php artisan serve

## Notes
If face error in sending process, it is curl problems.
Do step by step.
- download .pem file form <a herf="http://curl.haxx.se/ca/cacert.pem" target="_blank"> http://curl.haxx.se/ca/cacert.pem</a>
- Place this file in the `your running php path` folder
- Open php.iniand find this line:
- - ;curl.cainfo
- - Change it to:
- - curl.cainfo = "your running php path\cacert.pem"