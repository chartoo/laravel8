#!/bin/bash
eval "$(grep ^APP_NAME= .env)"
eval "$(grep ^HOST_PORT= .env)"
echo "Running you app : ${APP_NAME}"
open_appurl="http://localhost:${HOST_PORT}"
file=./.env
if [ ! -e "$file" ]; then
        echo ".env File does not exist"
else 
        if [ ! "$(docker ps -aq -f name=$APP_NAME)" ]; then
                docker-compose -f docker-compose.yml build 
                docker-compose -f docker-compose.yml up -d
                docker exec $APP_NAME bash -c "php artisan migrate"
        else 
                echo "Docker container : ${APP_NAME} already exist."
                docker restart $APP_NAME"_DB"
                echo "Database is starting."
                docker restart $APP_NAME
                echo "App is starting."
                docker restart $APP_NAME"_PMA"
                echo "PhpMyAdmin is starting."
        fi

        if [[ "$OSTYPE" == "linux-gnu"* ]]; then
                xdg-open $open_appurl
                
        elif [[ "$OSTYPE" == "darwin"* ]]; then
                open $open_appurl
                
        elif [[ "$OSTYPE" == "cygwin" ]]; then
                start $open_appurl
                
        elif [[ "$OSTYPE" == "msys" ]]; then
                start $open_appurl
                
        elif [[ "$OSTYPE" == "win32" ]]; then
                start $open_appurl
                
        else
                firefox $open_appurl
        fi
fi 
echo "Successfully completed!"
read -rn1