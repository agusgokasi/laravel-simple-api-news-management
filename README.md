# News Management

1. Clone your project ```git clone https://gitlab.com/agusgokasi/news-management.git```
2. Go to the folder application using ```cd news-management``` or where you put the file project on your cmd or terminal
3. Run ```composer install``` on your cmd or terminal
4. Copy .env.example file to .env on the root folder. You can type ```copy .env.example .env``` if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu ```cp .env.example .env```
5. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration and change QUEUE_CONNECTION=redis and field correspond to your configuration for the queue redis.
6. Run ```php artisan key:generate```
7. Run ```php artisan migrate```
8. Run ```php artisan db:seed```
9. Run ```php artisan passport:install```
10. Run ```php artisan storage:link```
11. Run ```php artisan serve```
12. Run ```php artisan queue:work``` to run queue process, eg: comment
14. Finally Go to this below Postman Documentation for checking the request i've created

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/14855183-516d07da-d8c2-4c14-acd4-d962b823aebc?action=collection%2Ffork&collection-url=entityId%3D14855183-516d07da-d8c2-4c14-acd4-d962b823aebc%26entityType%3Dcollection%26workspaceId%3Df1a62a9c-d06c-4187-a13e-8327c13bd33e)

---
**NOTE**

Admin Login :
    email : admin@mail.com,
    password : admin1234,

User Login :
    email : user@mail.com,
    password : user1234,

Or you can create own user via endpoint Register
---