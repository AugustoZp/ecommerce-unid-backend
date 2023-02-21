<?php
namespace clases; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class orders{

    private $db; //NO EDITAR//


    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct()
    {
        Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
        $this->db = Flight::db();
    }

    //Función select all orders//
    function selectall_orders()
    {
        $query = $this->db->prepare("SELECT * FROM orders");
        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
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
    }


    //Función select single order//
    function selectone_order($id)
    {
        $query = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $query->execute([":id" => $id]);
        $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'user_id' => $data['user_id'],
            'total_amount' => $data['total_amount'],
            'order_status' => $data['username'],
        ];
        Flight::json($array);
    }


    //Función insert order//
    function order_post()
    {
        $db = Flight::db();
        $user_id = Flight::request()->data->user_id;
        $total_amount = Flight::request()->data->total_amount;
    
        $query = $db->prepare("INSERT INTO orders (user_id,total_amount) VALUES (:user_id,:total_amount)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if($query->execute([":user_id" => $user_id, "total_amount" => $total_amount]))
        {
            $array = [
                "data" => [
                    
                    'id' => $db->lastInsertId(),
                    'user_id' => $user_id,
                    'total_amount' => $total_amount,
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }


    //Función put order//
    function orders_put()
    {
        $db = flight::db();
        $id = flight::request()->data->id;;
        $user_id = Flight::request()->data->user_id;
        $total_amount = Flight::request()->data->total_amount;
    
        
        $query = $db->prepare("UPDATE orders SET user_id = :user_id, total_amount = :total_amount WHERE id = :id ");
       
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if ($query->execute([ ":user_id" => $user_id, ":total_amount" => $total_amount, ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id,
                    "user_id" => $user_id,
                    "total_amount" => $total_amount,
                ],
                "status" => "success"
            ];
        }
       flight::json($array);
    }
    
    //Función delete order//
    function delete_orders()
    {
        $db = flight::db();
        $id = flight::request()->data->id;
        
        $query = $db->prepare("DELETE from orders WHERE id = :id");
       
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
