To run the project, add .env file with proper db and smtp(to send emails on events specified in task list) credentials, then run the following commands in given order,

npm install
npm run build
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

