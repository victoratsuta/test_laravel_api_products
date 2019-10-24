Test APP
===============

# Stack

1. Laravel
2. Mysql

# Deploy

2. pull repo
3. copy .env from .env.example
3. setup db en .env
`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=laravel`
`DB_USERNAME=root`
`DB_PASSWORD=`
4. `php artisan key:generate `
5. `composer install`
6. `php artisan storage:link`
7. `php artisan migrate:fresh --seed`
8. Run tests `vendor/bin/phpunit`
9. `php -S localhost:8000` to run local server for testing

# Endpoints

### Category
1. GET	`/api/category`	- get tree of categories
2. POST `/api/category`		- create category
3. GET	`/api/category/{id}`	- get category	
4. PUT/PATCH `/api/category/{id}` - update category
5. DELETE	`/api/category/{id}` - delete category	

### Product
1. GET	`/api/product`	- get list of products with pagination 
2. POST `/api/product`		- create product
3. GET	`/api/product/{id}`	- get product	
4. PUT/PATCH `/api/product/{id}` - update product
5. DELETE	`/api/product/{id}` - delete product	


