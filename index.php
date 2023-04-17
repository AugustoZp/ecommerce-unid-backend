<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


//Estas son las clases, si no es necesario, NO lo edites//
$users = new clases\users;
$categories = new clases\categories;
$products = new clases\products;
$orders = new clases\orders;
$order_detail = new clases\order_detail;
$roles = new clases\roles;



//get all users from database/
Flight::route('GET /all_users', [$users, 'selectall_users']);

//get a single user from database//
Flight::route('GET /one_user/@id', [$users, 'selectone_user']);

//POST users//
Flight::route('POST /insert_user', [$users, 'users_post']);

//PUT users//
Flight::route('PUT /edit_user', [$users, 'users_put']);

//DELETE users//
Flight::route('DELETE /delete_user', [$users, 'delete_users']);

//JWT auth//
Flight::route('POST /auth', [$users, 'JWT_auth']);

//JWT admin auth//
Flight::route('POST /admin', [$users, 'JWT_admin_auth']);

//getToken users// No se utiliza
//Flight::route('POST /getToken', [$users, 'getToken']);

//validateToken users// No se utiliza
//Flight::route('POST /validateToken', [$users, 'validateToken']);

//////////////////////////////


//get all products from database//
Flight::route('GET /all_products', [$products, 'selectall_products']);

//get a single product from database//
Flight::route('GET /one_product/@id', [$products, 'selectone_product']);

//POST products//
Flight::route('POST /insert_product', [$products, 'products_post']);

//PUT products//
Flight::route('PUT /edit_product', [$products, 'products_put']);

//DELETE products//
Flight::route('DELETE /delete_product', [$products, 'delete_products']);


//////////////////////////////


//get all roles from database//
Flight::route('GET /all_roles', [$roles, 'selectall_roles']);

//get a single role from database//
Flight::route('GET /one_role/@id', [$roles, 'selectone_rol']);

//POST roles//
Flight::route('POST /insert_role', [$roles, 'roles_post']);

//PUT roles//
Flight::route('PUT /edit_role', [$roles, 'roles_put']);

//DELETE roles//
Flight::route('DELETE /delete_role', [$roles, 'delete_roles']);


//////////////////////////////


//get all orders from database//
Flight::route('GET /all_orders', [$orders, 'selectall_orders']);

//get a single order from database//
Flight::route('GET /one_order/@id', [$orders, 'selectone_order']);

//POST orders//
Flight::route('POST /insert_order', [$orders, 'order_post']);

//PUT orders//
Flight::route('PUT /edit_order', [$orders, 'orders_put']);

//DELETE order//
Flight::route('DELETE /delete_order', [$orders, 'delete_orders']);


//////////////////////////////


//get all orders_details from database//
Flight::route('GET /all_order_details', [$order_detail, 'selectall_order_detail']);

//get a single order_detail from database//
Flight::route('GET /one_order_detail/@id', [$order_detail, 'selectone_order_detail']);

//POST order_details//
Flight::route('POST /insert_order_detail', [$order_detail, 'order_detail_post']);

//PUT order_details//
Flight::route('PUT /edit_order_detail', [$order_detail, 'order_detail_put']);

//DELETE order_details//
Flight::route('DELETE /delete_order_detail', [$order_detail, 'delete_order_detail']);


//////////////////////////////


//get all categories from database//
Flight::route('GET /all_categories', [$categories, 'selectall_categories']);

//get a single categorie from database//
Flight::route('GET /one_categorie/@id', [$categories, 'selectone_categorie']);

//POST categories//
Flight::route('POST /insert_categorie', [$categories, 'categories_post']);

//PUT categories//
Flight::route('PUT /edit_categorie', [$categories, 'categories_put']);

//DELETE categories//
Flight::route('DELETE /delete_categorie', [$categories, 'delete_categories']);

Flight::start();
?>

