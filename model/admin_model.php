<?php 

require  ("../db/connection.php");


class ADMIN extends Connection {


   

    public function validDayInit()
    {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set('America/El_Salvador');
        $fechaHoy = date('Y-m-d');
        $types  = 'APERTURA';
        try {
          
             $sql = "SELECT * FROM cachiers_management WHERE TYPE = :types && DATE = :dates";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":types", $types);
             $query->bindParam(":dates", $fechaHoy);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function validDayFinish()
    {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set('America/El_Salvador');
        $fechaHoy = date('Y-m-d');
        $types  = 'CIERRE';
        try {
          
             $sql = "SELECT * FROM cachiers_management WHERE TYPE = :types && DATE = :dates";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":types", $types);
             $query->bindParam(":dates", $fechaHoy);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

 


    /* PARTE DE LA AREA REFERENTE A DATOS DE LA EMPRESA   -----> ADMIN */

    public function obtenerDatosEmpresa()
    {
        try {
             $sql = "SELECT id, company_name, company_comercial_name, company_turn, company_slogan, legal_representative, postal_code, address, country, state, municipality, city, telephone, fax, email, nit, nrc, prefix FROM `company_profile`";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataMovements()
    {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('Y-m-d');

        try {
            $sql = "SELECT cachiers_movements.id, cachiers_movements.id_types_movements, cachiers_movtype.name,
            cachiers_movements.cod, cachiers_movements.date,  cachiers_movements.`type`, 
            cachiers_movements.mount, cachiers_movements.description 
            FROM cachiers_movements
            INNER JOIN cachiers_movtype ON cachiers_movements.id_types_movements = cachiers_movtype.id
            WHERE cachiers_movements.date = :datetim";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":datetim", $fecha);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
    }
    public function list_movementsTypes(){
        try {
             $sql = "SELECT id, name FROM cachiers_movtype ORDER BY create_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
       }

    
    public function obtenerDatosEmpresaProfile()
    {
        try {
             $sql = "SELECT id, company_name, company_comercial_name, company_turn, company_slogan, legal_representative, postal_code, address, country, state, municipality, city, telephone, fax, email, nit, nrc, prefix FROM `company_profile`";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetch();
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }



    public function updateCompany($data) {
        try {
            $sql = "UPDATE company_profile SET company_name = :company_name, company_comercial_name = :company_comercial_name, company_turn = :company_turn, company_slogan = :company_slogan, legal_representative = :legal_representative, postal_code = :postal_code, address = :address, country = :country, state = :state, municipality = :municipality, city = :city, telephone = :telephone, fax = :fax, email = :email, nit = :nit, nrc = :nrc WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":company_name", $data['company_name']);
            $query->bindParam(":company_comercial_name", $data['company_comercial_name']);
            $query->bindParam(":company_turn", $data['company_turn']);
            $query->bindParam(":company_slogan", $data['company_slogan']);
            $query->bindParam(":legal_representative", $data['legal_representative']);
            $query->bindParam(":postal_code", $data['postal_code']);
            $query->bindParam(":address", $data['address']);
            $query->bindParam(":country", $data['country']);
            $query->bindParam(":state", $data['state']);
            $query->bindParam(":municipality", $data['municipality']);
            $query->bindParam(":city", $data['city']);
            $query->bindParam(":telephone", $data['telephone']);
            $query->bindParam(":fax", $data['fax']);
            $query->bindParam(":email", $data['email']);
            $query->bindParam(":nit", $data['nit']);
            $query->bindParam(":nrc", $data['nrc']);
            $query->bindParam(":id", $data['id']);

            return $query->execute();

            $query->close();
        } catch (Exception $e) {
            echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
        }
    }
/* ddddddddddddddddddddddddddddddddddddd */

    public function inserMovements($datos){
        try {
            $sql = "INSERT INTO cachiers_movements (id_employe, id_types_movements, cod, type, mount, description) 
            VALUES (:id_employe, :id_types_movements, :cod, :type, :mount, :description)";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id_employe", $datos['id_employe']);
            $query->bindParam(":id_types_movements", $datos['type_movement']);
            $query->bindParam(":cod", $datos['codigo']);
            $query->bindParam(":type", $datos['afecta']);
            $query->bindParam(":mount", $datos['monto']);
            $query->bindParam(":description", $datos['description']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }

    public function createManagement($datos){
        try {


            $sql = "INSERT INTO cachiers_management (type, mount, id_employe, id_user) 
            VALUES (:type, :mount, :id_employe, :id_user)";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":type", $datos['type']);
            $query->bindParam(":mount", $datos['mount']);
            $query->bindParam(":id_employe", $datos['id_employe']);
            $query->bindParam(":id_user", $datos['id_user']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }




    public function valid_management()
    {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('Y-m-d');
        try {
            $sql = "SELECT mount FROM cachiers_management WHERE cachiers_management.`type` = 'APERTURA' && cachiers_management.date = :datetim";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":datetim", $fecha);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
    }
 
   

}
