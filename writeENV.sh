echo $GENERAL_ENV | tr " " "\n" >> .env
echo "DB_PASSWORD=$DB_PASSWORD" >> .env
echo "APP_KEY=$APP_KEY" >> .env