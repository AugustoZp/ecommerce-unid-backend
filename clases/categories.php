<?php
namespace clases; //NO EDITAR//
use Firebase\JWT\JWT; //NO EDITAR//
USE Firebase\JWT\Key; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class categories
{
    private $db; //NO EDITAR//


    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct()
    {
        Flight::register('db', 'PDO', array('mysql:host='.$_ENV['db_host'].';dbname='. $_ENV['db_name'],$_ENV['db_user'],$_ENV['db_pass']));
        $this->db = Flight::db();
    }

    
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


    //Función select all categories//
    function selectall_categories()
    {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
            $array[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'creation_date' => $row['creation_date'],
            ];
        }
        Flight::json([
            "total_rows"=> $query->rowcount(),
            "rows" => $array
        ]);
    }


    //Función select single categorie//
    function selectone_categorie($id)
    {
        $query = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $query->execute([":id" => $id]);
        $data = $query->Fetch();
    
        $array = [
            'id' => $data['id'],
            'name' => $data['name'],
            'image' => $data['image'],
            'creation_date' => $data['creation_date'],  
        ];    
        Flight::json($array);
    }


    //Función insert categorie//
    function categories_post()
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

        $name = $data->name;
        $image = $data->image;
        $creation_date = $data->creation_date;
        
    
        $query = $db->prepare("INSERT INTO categories (name, image, creation_date) VALUES (:name, :image, :creation_date)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if($query->execute([":name" => $name, ":image" => $image, ":creation_date" => $creation_date]))
        {
            $array = [
                "data" => [

                    'id' => $db->lastInsertId(),
                    'name' => $name,
                    'image' => $image,
                    'creation_date' => $creation_date,
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }


    //Función put categorie//
    function categories_put()
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
        $name = $data->name;
        $image = $data->image;
        $creation_date = $data->creation_date;
        

        $query = $db->prepare("UPDATE categories SET name = :name, image = :image, creation_date = :creation_date WHERE id = :id ");
       
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
        if ($query->execute([ ":name" => $name, ":image" => $image, ":creation_date" => $creation_date, ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id,
                    "name" => $name,
                    "image" => $image,
                    "creation_date" => $creation_date,

                ],
                "status" => "success"
            ];
        }
       flight::json($array);
    }

    //Función delete categorie//
    function delete_categories()
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
        
        $query = $db->prepare("DELETE from categories WHERE id = :id");
       
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
