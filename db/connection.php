<?php 

class Connection{
    public function connect(){
       /* Definiendo variables para la conexion */
       $server = "localhost";
       $user = "root";
       $password = "";
       $database = "ipos_systems"; 
 
       try{
          $connection = new PDO("mysql:host=$server; dbname=$database", "$user", "$password" );
          $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          return $connection;
       }catch(Exception $e){
          echo "Ocurrió algo con la base de datos: " . $e->getMessage();
       }
    }
 }

 class ConnectionTransaction{
   public function connectTransaction(){
      /* Definiendo variables para la conexion */
      $server = "localhost";
      $user = "root";
      $password = "";
      $database = "ipos_systems"; 

      try{
         $connection = new PDO("mysql:host=$server; dbname=$database", "$user", "$password" );
         $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
         return $connection;
      }catch(PDOException $e){
         echo "Ocurrió algo con la base de datos: " . $e->getMessage();
      }
   }
}

function conexion()
{

  error_reporting(0);
  $server = "localhost";
  $user = "root";
  $password = "";
  $database = "ipos_systems"; 
 
  $conexion  = mysqli_connect($server, $user, $password, $database);
  return $conexion;
  
}



?>