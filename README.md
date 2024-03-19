# Famous Quote Quiz

Unfortunately, I did not manage to implement the app configuration through the admin panel. I don't think it's necessary, but I will indicate where you can change the time limit setting: file:/resources/js/stores/quiz.js >> timeLimit: 300,

I also did not add Docker, so here are the instructions:
```
composer install
cp .env.example .env
php artisan key:generate
```
Settings in the .env file (What I changed)
```
APP_URL=http://localhost:8000
SESSION_DRIVER=cookie
DB_DATABASE={your_data}
DB_USERNAME={your_data}
DB_PASSWORD={your_data}
```
There is no database dump. All data can be obtained from migrations and seeders.

```
php artisan migrate
php artisan db:seed
npm install
npm run build
php artisan serve
```
You can view it at the link: http://localhost:8000

The task might have implied the use of design patterns, more varied tables, and other, more complex logic. However, I decided not to complicate the app's logic and opted for a simpler approach.


If, for some reason, the login details for the admin panel don't autofill, I'm duplicating them here.
```
test@example.com
password
```
