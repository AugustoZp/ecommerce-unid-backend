<?php
namespace clases; //NO EDITAR//
use Firebase\JWT\JWT; //NO EDITAR//
USE Firebase\JWT\Key; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class orders{

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
    
    //Función select all orders//
    function selectall_orders()
    {
        ////////////JOIN de user_id de la tabla ORDERS con el campo username de la tabla USERS//////////////
        $query = $this->db->prepare("SELECT 
        u.username AS 'username',
        o.id AS 'id',
        o.total_amount AS 'total_amount',
        o.order_status AS 'order_status',
        o.creation_date AS 'creation_date'
        FROM orders o
        JOIN users u 
        ON u.id = o.user_id");
        //////////Termina el JOIN de user_id de la tabla ORDERS con el campo username de la tabla USERS//////////////

        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
            $array[] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'total_amount' => $row['total_amount'],
                'order_status' => $row['order_status'],
                'creation_date' => $row['creation_date'],
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
        //////////JOIN de user_id de la tabla ORDERS con  el campo username de la tabla USERS//////////////
        $query = $this->db->prepare("SELECT 
        u.username AS 'username',
        o.id AS 'id',
        o.total_amount AS 'total_amount',
        o.order_status AS 'order_status',
        o.creation_date AS 'creation_date'
        FROM orders o
        JOIN users u 
        ON u.id = o.user_id
        WHERE o.id = :id");
        //////////Termina el JOIN de user_id de la tabla ORDERS con el campo username de la tabla USERS///////////

        $query->execute([":id" => $id]);
        $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'username' => $data['username'],
            'total_amount' => $data['total_amount'],
            'order_status' => $data['order_status'],
            'creation_date' => $data['creation_date'],
        ];
        Flight::json($array);
    }

    //Función insert order//
    function order_post()
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

        $user_id = $data->user_id;
        $total_amount = $data->total_amount;
        $order_status = $data->order_status;
        $creation_date = $data->creation_date;
        
    
        $query = $db->prepare("INSERT INTO orders (user_id, total_amount, order_status, creation_date) 
        VALUES (:user_id, :total_amount, :order_status, :creation_date)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if($query->execute([":user_id" => $user_id, ":total_amount" => $total_amount, ":order_status" => $order_status, ":creation_date" => $creation_date]))
        {
            $array = [
                "data" => [
                    
                    'id' => $db->lastInsertId(),
                    'user_id' => $user_id,
                    'total_amount' => $total_amount,
                    'order_status' => $order_status,
                    'creation_date' => $creation_date,
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }


    //Función put order//
    function orders_put()
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

        $id = $data->id;
        $user_id = $data->user_id;
        $total_amount = $data->total_amount;
        $order_status = $data->order_status;
        $creation_date = $data->creation_date;
        
        
        $query = $db->prepare("UPDATE orders SET user_id = :user_id, total_amount = :total_amount, order_status = :order_status,
         creation_date = :creation_date WHERE id = :id ");
       
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if ($query->execute([ ":user_id" => $user_id, ":total_amount" => $total_amount, ":order_status" => $order_status, 
        ":creation_date" => $creation_date, ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id,
                    "user_id" => $user_id,
                    "total_amount" => $total_amount,
                    "order_status" => $order_status,
                    "creation_date" => $creation_date,
                ],
                "status" => "success"
            ];
        }
       flight::json($array);
    }
    
    //Función delete order//
    function delete_orders()
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
