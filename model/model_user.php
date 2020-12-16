<?php 

require  ("../db/connection.php");


class USER extends Connection {


    public function list_data()
    {
        try {
             $sql = "SELECT u.id, u.email, u.state, p.name, p.surname, p.alias, p.position 
             FROM users u, users_profile p
             WHERE u.id = p.id_user";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }

    public function list_users()
    {
        try {
             $sql = "SELECT users.id, users.email, users.username, users.state, users_level.id AS level_id, users_level.name AS level_name 
             FROM users INNER JOIN users_level ON id_level = users_level.id ";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


   public function validate_login($data)
   {
       try {
            $sql = "SELECT users.id, users.email, users.username, users.password, users.state,
            users_level.`level` AS levels, users_level.name
            FROM users 
            INNER JOIN users_level ON users.id_level = users_level.id  WHERE (users.email = :email OR users.username = :email) AND users.password = :password ";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":email", $data['email'], PDO::PARAM_STR);
            $query->bindParam(":password", $data['password'], PDO::PARAM_STR);
            $query->execute();
            return $query->fetch();
       } catch (Exception $e) {
            echo "An error occurred in the data validation: " . $e->getMessage();
       }
       
   }


   public function getProfile($id_usuario)
   {
       $sql = "SELECT users_profile.id, users_profile.id_people, id_user, alias, users_profile.img AS imagen,
       users_profile.about, users_profile.POSITION, contact, system_people.*
       FROM users_profile 
       INNER JOIN system_people ON users_profile.id_people = system_people.id
       WHERE users_profile.id_user = :id_usuario";
       $query = Connection::connect()->prepare($sql);
       $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
       $query->execute();
       return $query->fetch();
       $query->close();
   }

   public function obtenerPassword($data)
   {
       $sql = "SELECT email FROM users WHERE users.id = :id_user AND users.password = :passw";
       $query = Connection::connect()->prepare($sql);
       $query->bindParam(":id_user",$data['id_user'], PDO::PARAM_STR);
       $query->bindParam(":passw", $data['passw'], PDO::PARAM_STR);
       $query->execute();
       return $query->fetch();
       $query->close();
   }

   public function modificarPassword(){
       $sql = "SELECT email FROM users WHERE users.id = :id_user AND users.password = :passw";
       $query = Connection::connect()->prepare($sql);
       $query->bindParam(":id_user",$data['id_user'], PDO::PARAM_STR);
       $query->bindParam(":passw", $data['passw'], PDO::PARAM_STR);
       $query->execute();
       return $query->fetch();
       $query->close();
   }

    public function getLevelUsers()
    {
        try {
            $sql = "SELECT id, name, level FROM users_level ORDER BY level";
            $query = Connection::connect()->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "An error occurred in the read data: " . $e->getMessage();
        }
    }

    public function user_exist($username) {
        try {
            $sql = "SELECT id, username FROM users WHERE username = :username";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(':username', $username);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "An error ocurred in the read data: " . $e->getMessage();
        }
    }

    function get_user_statuses() {
        try {
            $sql = "SELECT id, name, description FROM users_status";
            $query = Connection::connect()->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "An error ocurred in the read data: " . $e->getMessage();
        }
    }

   public function insertarPerfil($data){    
   }

   public function actualizarPerfil($data){
   }

   public function insertarUser($data){    
        try {
            $sql = "INSERT INTO users (email, username, password, state, id_level) VALUES ( :email, :username, :password, :status, :level)";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":email", $data['email']);
            $query->bindParam(":username", $data['username']);
            $query->bindParam(":password", $data['password']);
            $query->bindParam(":status", $data['status']);
            $query->bindParam(":level", $data['level']);

            $query->execute();
        } catch (Exception $e) {
            echo "An error ocurred while attempting to insert data: " . $e->getMessage();
        }
   }

    public function getUserById($id) {
        try {
            $sql = "SELECT id, email, username, state, id_level FROM users WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            
            $query->bindParam(":id", $id);

            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "An error ocurred while reading data: " . $e->getMessage();
        }
    }

    public function actualizarUser($data){
        try {
            $sql = "UPDATE users SET email = :email, username = :username, password = :password, state = :status,
             id_level = :level WHERE id = :id";
            $query = Connection::connect()->prepare($sql);

            $query->bindParam(":id", $data['id']);
            $query->bindParam(":email", $data['email']);
            $query->bindParam(":username", $data['username']);
            $query->bindParam(":password", $data['password']);
            $query->bindParam(":status", $data['status']);
            $query->bindParam(":level", $data['level']);

            return $query->execute();
            $query->close();
        } catch (Exception $e) {
            echo "An error ocurred while attempting to update data: " . $e->getMessage();
        }
    }

}