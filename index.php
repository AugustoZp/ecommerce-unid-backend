<?php
require 'vendor/autoload.php';

//Conexion de la base de datos//
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));


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
            'password' => $row['password'],
            'role_id' => $row['role_id'],
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

//get all roles from database//
Flight::route('GET /roles', function(){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM roles");
    $query->execute();
    $data = $query->FetchAll();
    // print_r($data);
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'name' => $row['name'],
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
            'category_id' => $row['category_id'],
            'product_name' => $row['product_name'],
            'price' => $row['price'],   
            'stock' => $row['stock'],
            'short_desc' => $row['short_desc'],
            'description' => $row['description'],
            'image' => $row['image'], 
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
            'image' => $row['image'],   
            'quantity' => $row['quantity'], 
            'price' => $row['price'],  
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
            'password' => $data['password'],
            'role_id' => $data['role_id'],
            'phone_number' => $data['phone_number'],
            'birth_date' => $data['birth_date'],
            'status' => $data['status']
        ];

    Flight::json($array);
});

//get a single role from database//
Flight::route('GET /roles/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM roles WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'name' => $data['name'],
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
            'name' => $data['name'],
            'image' => $data['image']    
        ];

    Flight::json($array);
});

//get a single product from database//ss
Flight::route('GET /products/@id', function($id){
    $db = Flight::db();
    $query = $db->prepare("SELECT * FROM products WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array[] = [
            'id' => $data['id'],
            'category_id' => $data['category_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],   
            'stock' => $data['stock'],
            'short_desc' => $data['short_desc'],
            'description' => $data['description'],
            'image' => $data['image'], 
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
            'image' => $data['image'],   
            'quantity' => $data['quantity'], 
            'price' => $data['price'],  
        ];
    
    Flight::json($array);
});

////////////////////////////////

Flight::start();
?>
