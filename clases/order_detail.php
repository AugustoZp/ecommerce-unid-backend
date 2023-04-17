<?php
namespace clases; //NO EDITAR//
use Firebase\JWT\JWT; //NO EDITAR//
USE Firebase\JWT\Key; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class order_detail
{
    private $db; //NO EDITAR//

    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct()
    {
        Flight::register('db', 'PDO', array('mysql:host='.$_ENV['db_host'].';dbname='. $_ENV['db_name'],$_ENV['db_user'],$_ENV['db_pass']));
        $this->db = Flight::db();
    }

    //Funcion Token users//
    function getToken()
    {
        $header = apache_request_headers();
        if (!isset($header["Authorization"]))
        {
            Flight::halt(403, json_encode([
            "error" => 'unauthenticated request',
            "status" => 'error'
            ]));            
        }
        $authorization = $header["Authorization"];
        $authorizationArray = explode(" ", $authorization);
        $token = $authorizationArray[1];
        $key = $_ENV['user_key'];
        try{
            return JWT::decode($token, new key($key, 'HS256'));
        }
        catch(\Throwable $th){
            Flight::halt(403, json_encode([
                "error" => $th ->getMessage(),
                "status" => 'error'
            ]));
        }
        return $token;
    }
     
    //Funcion Validar Token users//
    function validateToken()
    {
        $info = $this->getToken();
        $db= Flight::db();
        $query = $db->prepare("SELECT * FROM users where id = :id");            
        $query->execute([":id"=>$info->data]);
        $rows = $query->fetchColumn();
        return $rows;
    }

    //Función select all order_detail//
    function selectall_order_detail()
    {
         ////////Join de los Product_id de la tabla order_detail con  el campo Product_name de la tabla Products//////////////
        $query = $this->db->prepare("SELECT 
        p.product_name AS 'product_name',
        od.id AS 'id',
        od.order_id AS 'order_id',
        od.image AS 'image',
        od.quantity AS 'quantity',
        od.price AS 'price',
        od.creation_date AS 'creation_date'
        FROM order_detail od 
        JOIN products p 
        ON p.id = od.product_id;");
        ////////Termina el Join de los product_id con  el campo Product_name//////////////


        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
            $array[] = [
                'id' => $row['id'],
                'order_id' => $row['order_id'],
                'product_name' => $row['product_name'],
                'image' => $row['image'],
                'quantity' => $row['quantity'],
                'price' => $row['price'],
                'creation_date' => $row['creation_date'],
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
        ////////Join del product_id de la tabla order_detail con  el campo Product_name de la tabla Products//////////////
        $query = $this->db->prepare("SELECT 
        p.product_name AS 'product_name',
        od.id AS 'id',
        od.order_id AS 'order_id',
        od.image AS 'image',
        od.quantity AS 'quantity',
        od.price AS 'price',
        od.creation_date AS 'creation_date'
        FROM order_detail od 
        JOIN products p 
        ON p.id = od.product_id WHERE od.id = :id");
        ////////Termina el Join del product_id con  el campo Product_name//////////////

        $query->execute([":id" => $id]);
        $data = $query->Fetch();
    
        $array = [
            'id' => $data['id'],
            'order_id' => $data['order_id'],
            'product_name' => $data['product_name'],
            'image' => $data['image'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'creation_date' => $data['creation_date'],
        ];  
        Flight::json($array);
    }


    //Función insert order_detail//
    function order_detail_post()
    {
        if(!$this->validateToken())
        {
            Flight::halt(403, json_encode([
                "error" => 'Unauthorized',
                "status" => 'error'
            ]));
        }
        
        $body = Flight::request()->getBody();
        $data = json_decode($body);
        $db = Flight::db();

        $order_id  = $data->order_id;
        $product_id = $data->product_id;
        $image = $data->image;
        $quantity = $data->quantity;
        $price = $data->price;
        $creation_date = $data->creation_date;
        
        
        $query = $db->prepare("INSERT INTO order_detail (order_id, product_id, image, quantity, price, creation_date) 
        VALUES (:order_id, :product_id, :image, :quantity, :price,  :creation_date)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if($query->execute([":order_id" => $order_id, ":product_id" => $product_id, ":image" => $image, 
        ":quantity" => $quantity, ":price" => $price, ":creation_date" => $creation_date]))
        {
            $array = [
                "data" => [
    
                    'id' => $db->lastInsertId(),
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'image' => $image,
                    'quantity' => $quantity,
                    'price' => $price,
                    'creation_date' => $creation_date,
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }


    //Función put order_detail//
    function order_detail_put()
    {
        if(!$this->validateToken())
        {
            Flight::halt(403, json_encode([
                "error" => 'Unauthorized',
                "status" => 'error'
            ]));
        }
        
        $body = Flight::request()->getBody();
        $data = json_decode($body);
        $db = flight::db();

        $id = $data->id;
        $order_id = $data->order_id;
        $product_id = $data->product_id;
        $image = $data->image;
        $quantity = $data->quantity;
        $price = $data->price;
        $creation_date = $data->creation_date;
        

        
        $query = $db->prepare("UPDATE order_detail SET order_id = :order_id, product_id = :product_id, image = :image,
         quantity = :quantity, price = :price, creation_date = :creation_date WHERE id = :id ");
       
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if ($query->execute([ ":order_id" => $order_id, ":product_id" => $product_id, ":image" => $image, 
        ":quantity" => $quantity, ":price" => $price, ":creation_date" => $creation_date, ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id,
                    "order_id" => $order_id,
                    "product_id" => $product_id,
                    "image" => $image,
                    "quantity" => $quantity,
                    "price" => $price,
                    "creation_date" => $creation_date,
                ],
                "status" => "success"
            ];
        }
        flight::json($array);
    }

    //Función delete order_detail//
    function delete_order_detail()
    {
        if(!$this->validateToken())
        {
            Flight::halt(403, json_encode([
                "error" => 'Unauthorized',
                "status" => 'error'
            ]));
        }
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
