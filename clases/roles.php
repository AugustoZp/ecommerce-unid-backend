<?php
namespace clases; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class roles
{
    private $db; //NO EDITAR//

    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct()
    {
        Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
        $this->db = Flight::db();
    }


    //Función select all roles//
    function selectall_roles()
    {
        $query = $this->db->prepare("SELECT * FROM roles");
        $query->execute();
        $data = $query->FetchAll();
    
        $array = [];
        foreach ($data as $row)
        {
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


    //Función select single role//
    function selectone_rol($id)
    {
        $query = $this->db->prepare("SELECT * FROM roles WHERE id = :id");
        $query->execute([":id" => $id]);
        $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'name ' => $data['name'],
        ];
        Flight::json($array);
    }              


    //////////Está comentado porque no es necesario insertar nuevos roles, POR EL MOMENTO//////////
    
        //Función insertar roles//
    //     function roles_post(){
    //     $db = Flight::db();
    //     $name = Flight::request()->data->name;
    
    //     $query = $db->prepare("INSERT INTO roles (name) VALUES (:name)");
    
    //     $array = [
    //     "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
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
    //////////Está comentado porque no es necesario insertar nuevos roles, POR EL MOMENTO//////////
    
    
    //////////Está comentado porque no es necesario insertar nuevos roles, POR EL MOMENTO//////////
    //Función put user//
    //function roles_put(){
    //     $db = flight::db();
    //     $id = flight::request()->data->id;
    //     $name = flight::request()->data->name;
            
    //     $query = $db->prepare("UPDATE roles SET name = :name WHERE id = :id ");
           
    //    $array = [
    //     "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
    //     "status" => "error" 
    //     ];
        
    //    if ($query->execute([ ":name" => $name,":id" => $id])) {
    //     $array = [
    //         "data" => [
    //             "id" => $id,
    //             "name" => $name,
        
    //         ],
    //         "status" => "success"
    //     ];
    //    }
    //    flight::json($array);
    // }
    //////////Está comentado porque no es necesario insertar nuevos roles, POR EL MOMENTO//////////
    
    
    //////////Está comentado porque no es necesario insertar nuevos roles, POR EL MOMENTO//////////
    //Función delete roles//
    //function delete_roles(){
    //  $db = flight::db();
    //    $id = flight::request()->data->id;
        
    //   $query = $db->prepare("DELETE from roles WHERE id = :id");
       
    //  $array = [
    //       "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
    //      "status" => "error" 
    //       ];
    
    //  if ($query->execute([ ":id" => $id])) {
    //    $array = [
    //       "data" => [
    //           "id" => $id
    //     ],
    //     "status" => "success"
    //  ];
    // }
    //  flight::json($array);
    //}
    //////////Está comentado porque no es necesario insertar nuevos roles, POR EL MOMENTO//////////

}  

?>
