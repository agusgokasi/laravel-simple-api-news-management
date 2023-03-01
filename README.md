# News Management

1. Clone your project ```git clone https://gitlab.com/agusgokasi/news-management.git```
2. Go to the folder application using ```cd news-management``` or where you put the file project on your cmd or terminal
3. Run ```composer install``` on your cmd or terminal
4. Copy .env.example file to .env on the root folder. You can type ```copy .env.example .env``` if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu ```cp .env.example .env```
5. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
6. Run ```php artisan key:generate```
7. Run ```php artisan migrate:fresh --seed```
6. Run ```php artisan passport:install```
6. Run ```php artisan storage:link```
8. Run ```php artisan serve```
9. Go to http://localhost:8000/

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/14855183-516d07da-d8c2-4c14-acd4-d962b823aebc?action=collection%2Ffork&collection-url=entityId%3D14855183-516d07da-d8c2-4c14-acd4-d962b823aebc%26entityType%3Dcollection%26workspaceId%3Df1a62a9c-d06c-4187-a13e-8327c13bd33e)