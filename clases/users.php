<?php
namespace clases; //NO EDITAR//
use Firebase\JWT\JWT; //NO EDITAR//
USE Firebase\JWT\Key; //NO EDITAR//
require 'vendor/autoload.php'; //NO EDITAR//
use Flight; //NO EDITAR//


class users
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


    //Función select all users//
    function selectall_users()
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $data = $query->FetchAll();

        $array = [];
        foreach ($data as $row)
        {
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
                'creation_date'=>$row['creation_date'],
                'status' => $row['status']
            ];
        }
        Flight::json([
            "total_rows"=> $query->rowcount(),
            "rows" => $array,
        ]);
    }


    //Función select single user//
    function selectone_user($id)
    {
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
            'creation_date'=>$data['creation_date'],
            'status' => $data['status']
        ];
        Flight::json($array);
    }


    //Función insert user//
    function users_post()
    {
        //ESTA ES LA EDICIÓN DEL PROFESOR//
        $body = Flight::request()->getBody();
        $data = json_decode($body);
        
        $db = Flight::db();
        $name = $data->name;
        $last_name = $data->last_name;
        $username = $data->username;
        $email = $data->email;
        $address = $data->address;
        $password = $data->password;
        $phone_number = $data->phone_number;
        $birth_date = $data->birth_date; //////////Formato de insercion de cumpleaños es yyyy-mm-dd//////////
        $creation_date = $data->creation_date;
        //AQUI FINALIZA LA EDICIÓN DEL PROFESOR//

        $query = $db->prepare("INSERT INTO users (name, last_name, username, email, address, password, phone_number, birth_date, creation_date) 
        VALUES (:name, :last_name, :username, :email, :address, :password, :phone_number, :birth_date, :creation_date)");
    
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];

        if($query->execute([":name" => $name, ":last_name" => $last_name, ":username" => $username, ":email" => $email, ":address" => $address, 
        ":password" => $password, ":phone_number" => $phone_number, ":birth_date" => $birth_date, ":creation_date" => $creation_date]))
        {
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
                    'creation_date' => $creation_date,
                ],
                "status" => "success"
            ];
        }
        Flight::json($array);
    }


    //Función put user//
    function users_put()
    {
        if(!$this->validateToken())
        {
            Flight::halt(403, json_encode([
                "error" => 'Unauthorized',
                "status" => 'error'
            ]));
        }
        //ESTA ES LA EDICIÓN DEL PROFESOR//
        $body = Flight::request()->getBody();
        $data = json_decode($body);
        $db = Flight::db();

        $id = $data->id;
        $name = $data->name;
        $last_name = $data->last_name;
        $username = $data->username;
        $email = $data->email;
        $address = $data->address;
        $password = $data->password;
        $role_id = $data->role_id;
        $phone_number = $data->phone_number;
        $birth_date = $data->birth_date; //////////Formato de insercion de cumpleaños es yyyy-mm-dd//////////
        $creation_date = $data->creation_date;
        //AQUI FINALIZA LA EDICIÓN DEL PROFESOR//

        //ESTA ES NUESTRA EDICIÓN // NO ELIMINAR //
        //$db = flight::db();
        //$id = flight::request()->data->id;
        //$name = flight::request()->data->name;
        //$last_name = flight::request()->data->last_name;
        //$username = flight::request()->data->username;
        //$email = flight::request()->data->email;
        //$address = flight::request()->data->address;
        //$password = flight::request()->data->password;
        //$role_id = flight::request()->data->role_id;
        //$phone_number = flight::request()->data->phone_number;
        //$birth_date = flight::request()->data->birth_date;    //////////Formato de insercion de cumpleaños es yyyy-mm-dd//////////
        //AQUI FINALIZA NUESTRA EDICIÓN//
        
        $query = $db->prepare("UPDATE users SET name = :name, last_name = :last_name, username = :username, email = :email, address = :address,
        password = :password, role_id = :role_id, phone_number = :phone_number, birth_date = :birth_date, creation_date = :creation_date WHERE id = :id ");
       
        $array = [
        "error" => "Hubo un error al agregar los registros, por favor intenta mas tarde",
        "status" => "error" 
        ];
    
       if ($query->execute([ ":name" => $name, ":last_name" => $last_name, ":username" => $username, ":email" => $email, ":address" => $address,
       ":password" => $password, ":role_id" => $role_id, ":phone_number" => $phone_number, ":birth_date" => $birth_date,":creation_date" => $creation_date, ":id" => $id]))
        {
            $array = [
                "data" => [
                    "id" => $id,
                    "name" => $name,
                    "last_name" => $last_name,
                    "username" => $username,
                    "email" => $email,
                    "address" => $address,
                    "password" => $password,
                    "role_id" => $role_id,
                    "phone_number" => $phone_number,
                    "birth_date" => $birth_date,
                    "creation_date" => $creation_date,
                ],
                "status" => "success"
            ];
        }
       flight::json($array);
    }

    
    //Función delete user//
    function delete_users()
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
        
        $query = $db->prepare("DELETE from users WHERE id = :id");
       
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
    //Función JWT auth user//
    function JWT_auth()
    {
        $db = flight::db();
        $password = flight::request()->data->password;
        $email = flight::request()->data->email;
        $query = $db->prepare("SELECT * FROM users where email = :email and password = :password");
        $array = [
            "error" => "No se pudo validar su identidad por favor, intente de nuevo",
            "status" => "error"
    
        ];
        
        if ($query->execute([":email" => $email, ":password" => $password]))
        {
            $user = $query->fetch();
            $now = strtotime("now");
            $key = $_ENV['user_key'];
            $payload = [
            'exp' => $now + 3600,
            'data' => $user['id']
            ];
    
            $jwt = JWT::encode($payload, $key, 'HS256');
            $array = ["token" => $jwt];
    
            flight::json($array);
    
            
        }
    }
}

?>
