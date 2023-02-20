<?php
require 'vendor/autoload.php';

class categories{

    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct(){
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
    $this->db = Flight::db();
    }


    //Función selecionar todos las categories//
    function selectall_categories(){
    $query = $this->db->prepare("SELECT * FROM categories");
    $query->execute();
    $data = $query->FetchAll();

    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'image' => $row['image'],
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
}


    //Función selecionar una categorie//
    function selectone_categorie($id){
    $query = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'name' => $data['name'],
            'image' => $data['image'],
        ];    
    Flight::json($array);
}

    //Función insertar una categorie//
    function categories_post(){
    $db = Flight::db();
    $name = Flight::request()->data->name;

    $query = $db->prepare("INSERT INTO categories (name) VALUES (:name)");

    $array = [
    "error" => "Hubo un error al agregar los registros, por favor inteta mas tarde",
    "status" => "error" 
    ];

    if($query->execute([":name" => $name])) {
        $array = [
            "data" => [
                'id' => $db->lastInsertId(),
                'name' => $name,
            ],
            "status" => "success"
        ];
    }
    Flight::json($array);
}
}  

?>
