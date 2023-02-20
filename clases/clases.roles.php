<?php
require 'vendor/autoload.php';

class roles{


    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct(){
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
    $this->db = Flight::db();
}


    //Función selecionar todos los roles//
    function selectall_roles(){
    $query = $this->db->prepare("SELECT * FROM roles");
    $query->execute();
    $data = $query->FetchAll();

    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'name ' => $row['name'],
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
}


    //Función selecionar un rol//
    function selectone_rol($id){
    $query = $this->db->prepare("SELECT * FROM roles WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'name ' => $data['name'],
        ];

    Flight::json($array);
}              


//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////
    //Función insertar roles//
//     function roles_post(){
//     $db = Flight::db();
//     $name = Flight::request()->data->name;

//     $query = $db->prepare("INSERT INTO roles (name) VALUES (:name)");

//     $array = [
//     "error" => "Hubo un error al agregar los registros, por favor inteta mas tarde",
//     "status" => "error" 
//     ];

//     if($query->execute([":name" => $name])) {
//         $array = [
//             "data" => [
//                 'id' => $db->lastInsertId(),
//                 'name' => $name,
//             ],
//             "status" => "success"
//         ];
//     }
//     Flight::json($array);
// }
//////////Está comentado porque no es necesario insertar nuevos roles, por el momento//////////

}  

?>
