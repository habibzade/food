# Food Application
The Food_Application is a application for ...

## Installation project

Clone the project:
```sh
 git clone git@github.com:habibzade/food.git
```

Go to the project folder:
```sh
cd food 
```

Install the dependencies:
```sh
composer install 
```

Database structure:
```sh
php artisan migrate 
```

Seed data to types table:
```sh
php artisan db:seed --class=TypeSeeder
```

Seed data to foods table:
```sh
php artisan db:seed --class=FoodSeeder 
```

Serve the project:
```sh
php artisan serve
```

Finally visit:

http://127.0.0.1:8000/
