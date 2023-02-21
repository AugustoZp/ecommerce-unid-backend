<?php
namespace clases; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class products
{
    private $db; //NO EDITAR//

    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct()
    {
        Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
        $this->db = Flight::db();
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
        $db = Flight::db();
        $category_id = Flight::request()->data->category_id;
        $product_name = Flight::request()->data->product_name;
        $price = Flight::request()->data->price;
        $stock = Flight::request()->data->stock;
        $short_desc = Flight::request()->data->short_desc;
        $description = Flight::request()->data->description;
    
        $query = $db->prepare("INSERT INTO products (category_id, product_name, price, stock, short_desc, description) VALUES (:category_id, :product_name, :price, :stock, :short_desc, :description)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if($query->execute([":category_id" => $category_id, ":product_name" => $product_name, ":price" => $price, ":stock" => $stock, ":short_desc" => $short_desc, ":description" => $description]))
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
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }

    //Función put product//
    function products_put()
    {
        $db = flight::db();
        $id = flight::request()->data->id;
        $category_id = flight::request()->data->category_id;
        $product_name = flight::request()->data->product_name;
        $price = flight::request()->data->price;
        $stock = flight::request()->data->stock;
        $short_desc = flight::request()->data->short_desc;
        $description = flight::request()->data->description;

    
        $query = $db->prepare("UPDATE products SET category_id = :category_id, product_name = :product_name, price = :price, stock = :stock, short_desc = :short_desc,
        description = :description WHERE id = :id ");
   
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if ($query->execute([ ":category_id" => $category_id, ":product_name" => $product_name, ":price" => $price, ":stock" => $stock, ":short_desc" => $short_desc,
        ":description" => $description, ":id" => $id]))
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
               ],
               "status" => "success"
            ];
        }
        flight::json($array);
    }


    //Función delete product//
    function delete_products()
    {
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
