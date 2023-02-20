<?php
require 'vendor/autoload.php';

class order_detail{

    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct(){
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
    $this->db = Flight::db();
    }


    //Función selecionar todas las order_detail//
    function selectall_order_detail(){
    $query = $this->db->prepare("SELECT * FROM order_detail");
    $query->execute();
    $data = $query->FetchAll();

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
}


    //Función selecionar una order_detail//
    function selectone_order_detail($id){
    $query = $this->db->prepare("SELECT * FROM order_detail WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'order_id' => $data['order_id'],
            'product_id' => $data['product_id'],
            'image' => $data['image'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
        ];  
    Flight::json($array);
}


    //Función insertar una order_detail//
    function order_detail_post(){
    $db = Flight::db();
    $order_id  = Flight::request()->data->order_id ;
    $product_id = Flight::request()->data->product_id;
    $quantity = Flight::request()->data->quantity;
    $price = Flight::request()->data->price;

    $query = $db->prepare("INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (:order_id,:product_id, :quantity, :price)");

    $array = [
    "error" => "Hubo un error al agregar los registros, por favor inteta mas tarde",
    "status" => "error" 
    ];

    if($query->execute([":order_id" => $order_id, ":product_id" => $product_id, ":quantity" => $quantity, ":price" => $price])) {
        $array = [
            "data" => [

                'id' => $db->lastInsertId(),
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
            ],
            "status" => "success"
        ];
    }
    Flight::json($array);
}
}  

?>
