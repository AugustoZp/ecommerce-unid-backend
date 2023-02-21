<?php
namespace clases; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class order_detail
{
    private $db; //NO EDITAR//

    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct()
    {
        Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
        $this->db = Flight::db();
    }


    //Función select all order_detail//
    function selectall_order_detail()
    {
        $query = $this->db->prepare("SELECT * FROM order_detail");
        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
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


    //Función select single order_detail//
    function selectone_order_detail($id)
    {
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


    //Función insert order_detail//
    function order_detail_post()
    {
        $db = Flight::db();
        $order_id  = Flight::request()->data->order_id ;
        $product_id = Flight::request()->data->product_id;
        $quantity = Flight::request()->data->quantity;
        $price = Flight::request()->data->price;
    
        $query = $db->prepare("INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (:order_id,:product_id, :quantity, :price)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if($query->execute([":order_id" => $order_id, ":product_id" => $product_id, ":quantity" => $quantity, ":price" => $price]))
        {
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


    //Función put order_detail//
    function order_detail_put()
    {
        $db = flight::db();
        $id = flight::request()->data->id;
        $order_id = flight::request()->data->order_id;
        $product_id = flight::request()->data->product_id;
        $quantity = flight::request()->data->quantity;
        $price = flight::request()->data->price;

        
        $query = $db->prepare("UPDATE order_detail SET order_id = :order_id, product_id = :product_id, quantity = :quantity, price = :price WHERE id = :id ");
       
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if ($query->execute([ ":order_id" => $order_id, ":product_id" => $product_id, ":quantity" => $quantity, ":price" => $price, ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id,
                    "order_id" => $order_id,
                    "product_id" => $product_id,
                    "quantity" => $quantity,
                    "price" => $price,
                ],
                "status" => "success"
            ];
        }
        flight::json($array);
    }

    //Función delete order_detail//
    function delete_order_detail()
    {
        $db = flight::db();
        $id = flight::request()->data->id;
        
        $query = $db->prepare("DELETE from order_detail WHERE id = :id");
       
        $array = [
            "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
            "status" => "error" 
            ];
    
        if ($query->execute([ ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id
                ],
                "status" => "success"
            ];
        }
       flight::json($array);
    }
    
}  

?>
