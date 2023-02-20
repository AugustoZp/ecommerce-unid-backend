<?php
require 'vendor/autoload.php';
require 'clases/clases.users.php';
require 'clases/clases.products.php';
require 'clases/clases.orders.php';
require 'clases/clases.order_detail.php';
require 'clases/clases.categories.php';
require 'clases/clases.roles.php';

//Clases//
$users = new users();
$products = new products();
$orders = new orders();
$order_detail = new order_detail();
$categories = new categories();
$roles = new roles();


//get all users from database//
Flight::route('GET /users', [$users, 'selectall_users']);

//get a single user from database//
Flight::route('GET /users/@id', [$users, 'selectone_user']);

//POST users//
Flight::route('POST /users', [$users, 'users_post']);



//get all products from database//
Flight::route('GET /products', [$products, 'selectall_products']);

//get a single product from database//
Flight::route('GET /products/@id', [$products, 'selectone_product']);

//POST products//
Flight::route('POST /products', [$products, 'products_post']);



//get all roles from database//
Flight::route('GET /roles', [$roles, 'selectall_roles']);

//get a single rol from database//
Flight::route('GET /roles/@id', [$roles, 'selectone_rol']);

//////////Esta comnetodo porque no es necesario insertar nuevos roles, por el momento//////////
//POST roles//
// Flight::route('POST /roles', [$roles, 'roles_post']);
//////////Esta comnetodo porque no es necesario insertar nuevos roles, por el momento//////////


//get all orders from database//
Flight::route('GET /orders', [$orders, 'selectall_orders']);

//get a single order from database//
Flight::route('GET /orders/@id', [$orders, 'selectone_order']);

//POST orders//
Flight::route('POST /orders', [$orders, 'order_post']);



//get all orders_detail from database//
Flight::route('GET /order_detail', [$order_detail, 'selectall_order_detail']);

//get a single order_detail from database//
Flight::route('GET /order_detail/@id', [$order_detail, 'selectone_order_detail']);

//POST order_detail//
Flight::route('POST /order_detail', [$order_detail, 'order_detail_post']);


//get all categories from database//
Flight::route('GET /categories', [$categories, 'selectall_categories']);

//get a single categorie from database//
Flight::route('GET /categories/@id', [$categories, 'selectone_categorie']);

//POST categories//
Flight::route('POST /categories', [$categories, 'categories_post']);


Flight::start();
?>
/