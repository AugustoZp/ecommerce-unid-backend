<?php
require 'vendor/autoload.php';

class products{


    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct(){
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
    $this->db = Flight::db();
    }

    //Función selecionar todos los products//
    function selectall_products(){
    $query = $this->db->prepare("SELECT * FROM products");
    $query->execute();
    $data = $query->FetchAll();

    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'category_id ' => $row['category_id'],
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
}


    //Función selecionar un product//
    function selectone_product($id){
    $query = $this->db->prepare("SELECT * FROM products WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'category_id ' => $data['category_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'short_desc' => $data['short_desc'],
            'description' => $data['description'],
            'image' => $data['image'],
        ];
    Flight::json($array);
}


    //Función insertar un product//
    function products_post(){
    $db = Flight::db();
    $category_id = Flight::request()->data->category_id;
    $product_name = Flight::request()->data->product_name;
    $price = Flight::request()->data->price;
    $stock = Flight::request()->data->stock;
    $short_desc = Flight::request()->data->short_desc;
    $description = Flight::request()->data->description;

    $query = $db->prepare("INSERT INTO products (category_id, product_name, price, stock, short_desc, description) VALUES (:category_id, :product_name, :price, :stock, :short_desc, :description)");

    $array = [
    "error" => "Hubo un error al agregar los registros, por favor inteta mas tarde",
    "status" => "error" 
    ];

    if($query->execute([":category_id" => $category_id, ":product_name" => $product_name, ":price" => $price, ":stock" => $stock, ":short_desc" => $short_desc, ":description" => $description])) {
        $array = [
            "data" => [

                'id' => $db->lastInsertId(),
                'category_id' => $category_id,
                'product_name' => $product_name,
                'price' => $price,
                'stock' => $stock,
                'short_desc' => $short_desc,
                'description' => $description,
            ],
            "status" => "success"
        ];
    }
    Flight::json($array);
}
}  

?>
