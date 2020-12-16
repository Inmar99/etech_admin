<?php 

require  ("../db/connection.php");


class RRHH extends Connection {

     /**
      * Employee Segment
      */

      public function searchPeople($identity_documents)
    {
        try {
             $sql = "SELECT id, document_nit, email, CONCAT_WS(' ', NAME, NAME2, surname, surname2) AS name  FROM system_people WHERE identity_documents = :identity_documents";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":identity_documents", $identity_documents);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function searchEmployee($identity_documents)
    {
        try {
             $sql = "SELECT employees.id,employees.cod, employees.cargo, employees.id_departament, identity_documents, document_nit, email, CONCAT_WS(' ', NAME, NAME2, surname, surname2) AS NAME  
             FROM system_people 
             INNER JOIN employees ON system_people.id = employees.id_people
             WHERE employees.id = :identity_documents";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":identity_documents", $identity_documents);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function validateExistEmployee($id){
         try {
               $sql = "SELECT employees.id, employees.cod FROM employees INNER JOIN system_people ON employees.id_people = system_people.id
               WHERE system_people.identity_documents = :id";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":id", $id);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
    }

    public function createCodEmployee(){
     try {
          $sql = "SELECT COUNT(id) AS num, cod  FROM employees";
          $query = Connection::connect()->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     } 
    }

    public function createEmployee($datos){
          // iniciar transacción
          $conn = Connection::connect();
          $conn->beginTransaction();

          try {
          
          $sql = 'INSERT INTO users (email, username, password, state, id_level) VALUES (:email, :username, :password, :state, :id_level)';
          $query = $conn->prepare($sql);
          $query->bindParam(":email", $datos['correo']);
          $query->bindParam(":username", $datos['user']);
          $query->bindParam(":password", $datos['password']);
          $query->bindParam(":state", $datos['estate']);
          $query->bindParam(":id_level", $datos['level']);
          $query->execute();
          $lastId = $conn->lastInsertId();

          $sql = 'INSERT INTO users_profile (id_people, id_user, alias, position) VALUES (:id_people, :id_user, :alias, :position)';
          $query = $conn->prepare($sql);
          $query->bindParam(":id_people", $datos['id_people']);
          $query->bindParam(":id_user", $lastId);
          $query->bindParam(":alias", $datos['alias']);
          $query->bindParam(":position", $datos['cargo']);
          $query->execute();


          $sql = 'INSERT INTO employees (cod, id_people, id_user, id_departament, cargo) VALUES (:cod, :id_people, :id_user, :id_departament, :cargo)';
          $query = $conn->prepare($sql);
          $query->bindParam(":cod", $datos['codigo']);
          $query->bindParam(":id_people", $datos['id_people']);
          $query->bindParam(":id_user", $lastId);
          $query->bindParam(":id_departament", $datos['departament']);
          $query->bindParam(":cargo", $datos['cargo']);
         

          $conn->commit();
          return  $query->execute();
          } catch (PDOException $e) {
          
          $conn->rollback();
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }

 }


 public function updateEmployee($datos){
     try {
          $sql = "UPDATE employees SET cod = :cod , id_departament = :id_departament, cargo = :cargo WHERE id = :id";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":cod", $datos['codigo']);
          $query->bindParam(":id_departament", $datos['departament']);
          $query->bindParam(":cargo", $datos['cargo']);
          $query->bindParam(":id", $datos['id']);
          return $query->execute();
          $query->close();
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }
 }

 public function list_data_employees() {

     try {
          $sql = "SELECT employees.id, employees.cod, employees.cargo, CONCAT_WS(' ', system_people.name, system_people.name2, system_people.surname, system_people.surname2) AS NAME, departaments.name AS departament
          FROM employees
          INNER JOIN system_people ON employees.id_people = system_people.id
          INNER JOIN departaments ON  employees.id_departament = departaments.id
          ORDER BY employees.cod";
          $query = Connection::connect()->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }

 }


 /* AREA OF MARKER  */

 public function getEmployeeMarkerCod($cod) {

     try {
          $sql = "SELECT employees.id, CONCAT_WS(' ',system_people.name, system_people.name2, system_people.surname, system_people.surname2 ) AS name_employee 
          FROM employees
          INNER JOIN system_people ON employees.id_people = system_people.id
          WHERE cod = :cod";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":cod", $cod);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }

 }

 public function searchMaxEmployee()
 {
     try {
          $sql = "SELECT MAX(id) AS id FROM employees";
          $query = Connection::connect()->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }
 }

 public function getDataEmployee($id)
 {
     try {
          $sql = "SELECT employees.cod, employees.cargo, CONCAT_WS(' ', system_people.name, system_people.name2, system_people.surname, system_people.surname2 ) AS name_people, system_people.email, users.username, users.password
          FROM employees 
          INNER JOIN system_people ON employees.id_people = system_people.id
          INNER JOIN users ON employees.id_user = users.id
          WHERE employees.id = :id";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":id", $id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }
 }
 


 


 public function generateMarkerEmployee($datos){
     try {
         $sql = "INSERT INTO employees_marker (id_employee, employees_marker.`type`) VALUES (:id, :type)";
         $query = Connection::connect()->prepare($sql);
         $query->bindParam(":id", $datos['id']);
         $query->bindParam(":type", $datos['type']);
         return $query->execute();
         $query->close();
    } catch (Exception $e) {
         echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
    }  
 }

 public function searchMarkerEmployee($datos)
 {
     try {
          $sql = "SELECT COUNT(*)  AS number_marker
          FROM employees_marker 
          WHERE employees_marker.id_employee = :id_employee AND DATE(employees_marker.date) = :date";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":id_employee", $datos['id_employee']);
          $query->bindParam(":date", $datos['date']);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }
 }


 

 



      /**
      * Departaments Segment
      */

    public function list_data_departaments()
    {
        try {
             $sql = "SELECT id, cod, name, description FROM departaments ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
    }

    public function listDataDepartamentsToId($id)
    {
        try {
             $sql = "SELECT id, cod, name, description FROM departaments WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
    }

    public function insertDepartament($datos){
        try {
            $sql = "INSERT INTO departaments (cod,name,description) 
                            VALUES (:cod, :name, :description)";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":name", $datos['name']);
            $query->bindParam(":description", $datos['description']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }

    public function updateDepartament($datos){
        try {
            $sql = "UPDATE departaments SET cod = :cod, name = :name, description = :description WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":name", $datos['name']);
            $query->bindParam(":description", $datos['description']);
            $query->bindParam(":id", $datos['id']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
       }  
    }

    public function deleteDepartament($id){
        try {
            $sql = "DELETE FROM  departaments WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id", $id);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }



}



?>