<?php
require 'vendor/autoload.php';

//Conexion de la base de datos//
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=id20281525_ecommerce_unid','id20281525_eladmin','back/Back/03'));


//get all users from database//
Flight::route('GET /users', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM users");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'last_name' => $row['last_name'],
            'username' => $row['username'],
            'email' => $row['email'],
            'address' => $row['address'],
            'state' => $row['state'],
            'city' => $row['city'],
            'password' => $row['password'],
            'role' => $row['role'],
            'phone_number' => $row['phone_number'],
            'birth_date' => $row['birth_date'],
            'status' => $row['status']
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
});

//get all sellers from database//
Flight::route('GET /sellers', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM sellers");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'name' => $row['name'],
            'last_name' => $row['last_name'],
            'username' => $row['username'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            'role' => $row['role'],
            'status' => $row['status']
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
});

//get all categories from database//
Flight::route('GET /categories', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM categories");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'seller_id' => $row['seller_id'],
            'name' => $row['name'],
            'image' => $row['image']    
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
});

//get all products from database//
Flight::route('GET /products', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM products");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'seller_id' => $row['seller_id'],
            'category_id' => $row['category_id'],
            'product_name' => $row['product_name'],
            'price' => $row['price'],   
            'quantity' => $row['quantity'],
            'short_desc' => $row['short_desc'],
            'description' => $row['description'],
            'image' => $row['image'], 
            'available' => $row['available'], 
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
});

//get all orders from database//
Flight::route('GET /orders', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM orders");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'user_email' => $row['user_email'],
            'order_address' => $row['order_address'],
            'total_amount' => $row['total_amount'],    
            'order_status' => $row['order_status'],    
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
});

//get all order_detail from database//
Flight::route('GET /order_detail', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM order_detail");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'order_id' => $row['order_id'],
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'order_adress' => $row['order_address'],
            'state' => $row['state'],
            'city' => $row['city'],  
            'image' => $row['image'],   
            'quantity' => $row['quantity'], 
            'total_amount' => $row['total_amount'],  
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
});

////////////////////////////////

//get a single user from database//
Flight::route('GET /users/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM users WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'address' => $data['address'],
            'state' => $data['state'],
            'city' => $data['city'],
            'password' => $data['password'],
            'role' => $data['role'],
            'phone_number' => $data['phone_number'],
            'birth_date' => $data['birth_date'],
            'status' => $data['status']
        ];

    Flight::json($array);
});

//get a single seller from database//
Flight::route('GET /sellers/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM sellers WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();
    
        $array[] = [
            'id' => $data['id'],
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
            'status' => $data['status']
        ];
    
    Flight::json($array);
});

//get a single categorie from database//
Flight::route('GET /categories/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM categories WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array[] = [
            'id' => $data['id'],
            'seller_id' => $data['seller_id'],
            'name' => $data['name'],
            'image' => $data['image']    
        ];

    Flight::json($array);
});

//get a single product from database//
Flight::route('GET /products/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM products WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array[] = [
            'id' => $data['id'],
            'seller_id' => $data['seller_id'],
            'category_id' => $data['category_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],   
            'quantity' => $data['quantity'],
            'short_desc' => $data['short_desc'],
            'description' => $data['description'],
            'image' => $data['image'], 
            'available' => $data['available'], 
        ];

    Flight::json($array);
});

//get a single order from database//
Flight::route('GET /orders/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM orders WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();
    
        $array[] = [
            'id' => $data['id'],
            'user_id' => $data['user_id'],
            'user_email' => $data['user_email'],
            'order_address' => $data['order_address'],
            'total_amount' => $data['total_amount'],    
            'order_status' => $data['order_status'],  
        ];

    Flight::json($array);
});

//get a single order_detail from database//
Flight::route('GET /order_detail/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM order_detail WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array[] = [
            'id' => $data['id'],
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'order_adress' => $data['order_address'],
            'state' => $data['state'],
            'city' => $data['city'],  
            'image' => $data['image'],   
            'quantity' => $data['quantity'], 
            'total_amount' => $data['total_amount'],  
        ];
    
    Flight::json($array);
});

////////////////////////////////




Flight::start();
?>