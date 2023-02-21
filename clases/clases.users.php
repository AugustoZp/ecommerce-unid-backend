<?php
require 'vendor/autoload.php';

class users{


    //Función constructor CONEXIÓN A BASE DE DATOS, No modificar el DB//
    function __construct(){
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=ecommerce_unid','root',''));
    $this->db = Flight::db();
    }


    //Función selecionar todos los usuarios//
    function selectall_users(){
    $query = $this->db->prepare("SELECT * FROM users");
    $query->execute();
    $data = $query->FetchAll();
    $array = [];
    foreach ($data as $row){
        $array[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'last_name' => $row['last_name'],
            'username' => $row['username'],
            'email' => $row['email'],
            'address' => $row['address'],
            'password' => $row['password'],
            'role_id' => $row['role_id'],
            'phone_number' => $row['phone_number'],
            'birth_date' => $row['birth_date'],
            'status' => $row['status']
        ];
    }
    Flight::json([
        "total_rows"=> $query->rowcount(),
        "rows" => $array
    ]);
}


    //Función selecionar un usuario//
    function selectone_user($id){
    $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
    $query->execute([":id" => $id]);
    $data = $query->Fetch();

        $array = [
            'id' => $data['id'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => $data['password'],
            'role_id' => $data['role_id'],
            'phone_number' => $data['phone_number'],
            'birth_date' => $data['birth_date'],
            'status' => $data['status']
        ];
    Flight::json($array);
}


    //Función insertar un usuario//
    function users_post(){
    $db = Flight::db();
    $name = Flight::request()->data->name;
    $last_name = Flight::request()->data->last_name;
    $username = Flight::request()->data->username;
    $email = Flight::request()->data->email;
    $address = Flight::request()->data->address;
    $password = Flight::request()->data->password;
    $phone_number = Flight::request()->data->phone_number;
    
    $birth_date = Flight::request()->data->birth_date;   //////////Formato de insercion de cumpleaños es yyyy-mm-dd//////////

    $query = $db->prepare("INSERT INTO users (name, last_name, username, email, address, password, phone_number, birth_date) VALUES (:name, :last_name, :username, :email, :address, :password, :phone_number, :birth_date)");

    $array = [
    "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
    "status" => "error" 
    ];

    if($query->execute([":name" => $name, ":last_name" => $last_name, ":username" => $username, ":email" => $email, ":address" => $address, ":password" => $password, ":phone_number" => $phone_number, ":birth_date" => $birth_date])) {
        $array = [
            "data" => [

                'id' => $db->lastInsertId(),
                'name' => $name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'address' => $address,
                'password' => $password,
                'phone_number' => $phone_number,
                'birth_date' => $birth_date,   
            ],
            "status" => "success"
        ];
    }

    Flight::json($array);
}


    //Función put user//
    function users_put(){
        $db = flight::db();
        $id = flight::request()->data->id;
        $name = flight::request()->data->name;
        $last_name = flight::request()->data->last_name;
        $username = flight::request()->data->username;
        $email = flight::request()->data->email;
        $address = flight::request()->data->address;
        $password = flight::request()->data->password;
        $role_id = flight::request()->data->role_id;
        $phone_number = flight::request()->data->phone_number;
        $birth_date = flight::request()->data->birth_date;    //////////Formato de insercion de cumpleaños es yyyy-mm-dd//////////
        
        $query = $db->prepare("UPDATE users SET name = :name, last_name = :last_name, username = :username, email = :email, address = :address,
        password = :password, role_id = :role_id, phone_number = :phone_number, birth_date = :birth_date WHERE id = :id ");
       
       $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
       if ($query->execute([ ":name" => $name, ":last_name" => $last_name, ":username" => $username, ":email" => $email, ":address" => $address,
       ":password" => $password, ":role_id" => $role_id, ":phone_number" => $phone_number, ":birth_date" => $birth_date, ":id" => $id])) {
        $array = [
            "data" => [
                "id" => $id,
                "name" => $name,
                "last_name" => $last_name,
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "role_id" => $role_id,
                "phone_number" => $phone_number,
                "birth_date" => $birth_date,
    
            ],
            "status" => "success"
        ];
       }
       flight::json($array);
    }

    
    //Función delete user//
    function delete_users(){
        $db = flight::db();
        $id = flight::request()->data->id;
        
        $query = $db->prepare("DELETE from users WHERE id = :id");
       
        $array = [
            "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
            "status" => "error" 
            ];
    
       if ($query->execute([ ":id" => $id])) {
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
