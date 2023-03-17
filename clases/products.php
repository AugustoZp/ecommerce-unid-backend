<?php
namespace clases; //NO EDITAR//
use Firebase\JWT\JWT; //NO EDITAR//
USE Firebase\JWT\Key; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class products
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
        $query = $db->prepare("SELECT * FROM products where id = :id");            
        $query->execute([":id"=>$info->data]);
        $rows = $query->fetchColumn();
    return $rows;
}

    //Función select all products//
    function selectall_products()
    {
        $query = $this->db->prepare("SELECT * FROM products");
        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
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


    //Función select single product//
    function selectone_product($id)
    {
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


    //Función insert product//
    function products_post()
    {
        if(!$this->validateToken())
        {
            Flight::halt(403, json_encode([
                "error" => 'Unauthorized',
                "status" => 'error'
            ]));
        }
        $db = Flight::db();
        $category_id = Flight::request()->data->category_id;
        $product_name = Flight::request()->data->product_name;
        $price = Flight::request()->data->price;
        $stock = Flight::request()->data->stock;
        $short_desc = Flight::request()->data->short_desc;
        $description = Flight::request()->data->description;
        $image = Flight::request()->data->image;
    
        $query = $db->prepare("INSERT INTO products (category_id, product_name, price, stock, short_desc, description, image) VALUES (:category_id, :product_name, :price, :stock, :short_desc, :description, :image)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if($query->execute([":category_id" => $category_id, ":product_name" => $product_name, ":price" => $price, ":stock" => $stock, ":short_desc" => $short_desc, ":description" => $description, ":image" => $image]))
        {
            $array = [
                "data" => [
    
                    'id' => $db->lastInsertId(),
                    'category_id' => $category_id,
                    'product_name' => $product_name,
                    'price' => $price,
                    'stock' => $stock,
                    'short_desc' => $short_desc,
                    'description' => $description,
                    'image' => $image,
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }

    //Función put product//
    function products_put()
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
        $category_id = flight::request()->data->category_id;
        $product_name = flight::request()->data->product_name;
        $price = flight::request()->data->price;
        $stock = flight::request()->data->stock;
        $short_desc = flight::request()->data->short_desc;
        $description = flight::request()->data->description;
        $image = flight::request()->data->image;

    
        $query = $db->prepare("UPDATE products SET category_id = :category_id, product_name = :product_name, price = :price, stock = :stock, short_desc = :short_desc,
        description = :description, image = :image WHERE id = :id ");
   
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if ($query->execute([ ":category_id" => $category_id, ":product_name" => $product_name, ":price" => $price, ":stock" => $stock, ":short_desc" => $short_desc,
        ":description" => $description, ":image" => $image, ":id" => $id]))
        {
            $array = [
               "data" => [
                   "id" => $id,
                   "category_id" => $category_id,
                   "product_name" => $product_name,
                   "price" => $price,
                   "stock" => $stock,
                   "short_desc" => $short_desc,
                   "description" => $description,
                   "image" => $image,
               ],
               "status" => "success"
            ];
        }
        flight::json($array);
    }


    //Función delete product//
    function delete_products()
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
        
        $query = $db->prepare("DELETE from products WHERE id = :id");
       
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
