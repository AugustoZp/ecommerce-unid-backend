<?php
require 'vendor/autoload.php';

//Estas son las clases, si no es necesario, NO lo edites//
$users = new clases\users;
$categories = new clases\categories;
$products = new clases\products;
$orders = new clases\orders;
$order_detail = new clases\order_detail;
$roles = new clases\roles;


//get all users from database//
Flight::route('GET /users', [$users, 'selectall_users']);

//get a single user from database//
Flight::route('GET /users/@id', [$users, 'selectone_user']);

//POST users//
Flight::route('POST /users', [$users, 'users_post']);

//PUT users//
Flight::route('PUT /users', [$users, 'users_put']);

//DELETE users//
Flight::route('DELETE /users', [$users, 'delete_users']);

//////////////////////////////


//get all products from database//
Flight::route('GET /products', [$products, 'selectall_products']);

//get a single product from database//
Flight::route('GET /products/@id', [$products, 'selectone_product']);

//POST products//
Flight::route('POST /products', [$products, 'products_post']);

//PUT products//
Flight::route('PUT /products', [$products, 'products_put']);

//DELETE products//
Flight::route('DELETE /products', [$products, 'delete_products']);


//////////////////////////////


//get all roles from database//
Flight::route('GET /roles', [$roles, 'selectall_roles']);

//get a single rol from database//
Flight::route('GET /roles/@id', [$roles, 'selectone_rol']);

//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////
//POST roles//
// Flight::route('POST /roles', [$roles, 'roles_post']);
//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////

//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////
//PUT roles//
// Flight::route('PUT /roles', [$roles, 'roles_put']);
//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////

//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////
//DELETE roles//
// Flight::route('DELETE /roles', [$roles, 'delete_roles']);
//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////


//////////////////////////////


//get all orders from database//
Flight::route('GET /orders', [$orders, 'selectall_orders']);

//get a single order from database//
Flight::route('GET /orders/@id', [$orders, 'selectone_order']);

//POST orders//
Flight::route('POST /orders', [$orders, 'order_post']);

//PUT orders//
Flight::route('PUT /orders', [$orders, 'orders_put']);

//DELETE order//
Flight::route('DELETE /orders', [$orders, 'delete_orders']);


//////////////////////////////


//get all orders_detail from database//
Flight::route('GET /order_detail', [$order_detail, 'selectall_order_detail']);

//get a single order_detail from database//
Flight::route('GET /order_detail/@id', [$order_detail, 'selectone_order_detail']);

//POST order_detail//
Flight::route('POST /order_detail', [$order_detail, 'order_detail_post']);

//PUT order_detail//
Flight::route('PUT /order_detail', [$order_detail, 'order_detail_put']);

//DELETE order_detail//
Flight::route('DELETE /order_detail', [$order_detail, 'delete_order_detail']);


//////////////////////////////


//get all categories from database//
Flight::route('GET /categories', [$categories, 'selectall_categories']);

//get a single categorie from database//
Flight::route('GET /categories/@id', [$categories, 'selectone_categorie']);

//POST categories//
Flight::route('POST /categories', [$categories, 'categories_post']);

//PUT categories//
Flight::route('PUT /categories', [$categories, 'categories_put']);

//DELETE categories//
Flight::route('DELETE /categories', [$categories, 'delete_categories']);


Flight::start();
?>

