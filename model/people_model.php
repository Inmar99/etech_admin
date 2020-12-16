<?php 

require  ("../db/connection.php");


class PEOPLES extends Connection {


    public function list_data()
    {
        try {
             $sql = "SELECT id,identity_documents, document_nit, name,name2, surname, surname2, landline, email, type_person,work_place, update_SRV FROM system_people ORDER BY update_SRV DESC";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }

    public function list_cot()
    {
        try {
             $sql = "SELECT 
             * 
             FROM cotizaciones 
             INNER JOIN system_clients ON cotizaciones.id_cliente = system_clients.id
             INNER JOIN system_people ON system_clients.id_people = system_people.id
             ";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


    

    public function list_data_clients()
    {
        try {
             $sql = "SELECT system_clients.id, system_people.id AS id_people, identity_documents, document_nit, name,name2, surname, surname2, landline, email, type_person,work_place 
             FROM system_people
             INNER JOIN system_clients ON system_people.id = system_clients.id_people";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


    public function list_countries()
    {
        try {
             $sql = "SELECT id, NAME, nationality FROM sys_countries";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


    public function list_departaments($id_country)
    {
        try {
             $sql = "SELECT id, NAME FROM sys_departments WHERE id_country = :id_country";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id_country", $id_country);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }

    public function list_municipalities($id_departament)
    {
        try {
             $sql = "SELECT id, NAME FROM sys_municipalities WHERE id_departament = :id_departament";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id_departament", $id_departament);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }

    public function get_nationality($id_pais)
    {
        try {
             $sql = "SELECT  nationality FROM sys_countries WHERE id = :id_pais";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id_pais", $id_pais);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


    public function get_person_profile($id)
    {
        try {
             $sql = "SELECT p.id, p.type_person, p.identity_documents, p.document_nit, p.profession, p.email, p.landline, p.cell_phone, p.work_place, 
             CONCAT_WS(' ', p.name, p.name2, p.surname, p.surname2) as persona, p.position,p.direction,
             d.name AS department,
             c.name AS country,
             m.name 
             FROM system_people p
             INNER JOIN sys_departments d ON p.id_department = d.id
             INNER JOIN sys_countries c ON p.id_country_residence = c.id
             INNER JOIN sys_municipalities m ON p.id_municipality = m.id
             WHERE p.id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


    public function is_client($id)
    {
        try {
             $sql = " SELECT id FROM system_clients WHERE system_clients.id_people = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }

    public function insert_client($id)
    {
        try {
             $sql = "INSERT INTO system_clients (id_people) VALUES (:id)";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             return $query->execute();
             $query->close();
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }


    public function insertarPeople($datos){   

        $sql = "INSERT INTO system_people (document_nit,type_person,identity_documents, broadcast_date, expiration_date, place_emission,
        birth_date, place_birth, passport_document, document_visa, drivers_license, profession, name, name2, surname, surname2, id_country_nationality,
        nationality,id_country_residence, id_department, id_municipality, direction, email, landline, cell_phone, whattsapp, marital_status,
        work_place, position) 
                                  VALUES (:document_nit,:type_person ,:identity_documents, :broadcast_date, :expiration_date, :place_emission,
         :birth_date, :place_birth, :passport_document, :document_visa, :drivers_license, :profession, :name, :name2, :surname, :surname2, :id_country_nationality,
         :nationality, :id_country_residence, :id_department, :id_municipality, :direction, :email, :landline, :cell_phone, :whattsapp, :marital_status,
         :work_place, :position)";

        $query = Connection::connect()->prepare($sql);
        $query->bindParam(":document_nit", $datos['document_nit']);
        $query->bindParam(":type_person", $datos['type_person']);
        $query->bindParam(":identity_documents", $datos['identity_documents']);
        $query->bindParam(":broadcast_date", $datos['broadcast_date']);
        $query->bindParam(":expiration_date", $datos['expiration_date']);
        $query->bindParam(":place_emission", $datos['place_emission']);
        $query->bindParam(":birth_date", $datos['birth_date']);
        $query->bindParam(":place_birth", $datos['place_birth']);
        $query->bindParam(":passport_document", $datos['passport_document']);
        $query->bindParam(":document_visa", $datos['document_visa']);
        $query->bindParam(":drivers_license", $datos['drivers_license']);
        $query->bindParam(":profession", $datos['profession']);
        $query->bindParam(":name", $datos['name']);
        $query->bindParam(":name2", $datos['name2']);
        $query->bindParam(":surname", $datos['surname']);
        $query->bindParam(":surname2", $datos['surname2']);
        $query->bindParam(":id_country_nationality", $datos['id_country_nationality']);
        $query->bindParam(":nationality", $datos['nationality']);
        $query->bindParam(":id_country_residence", $datos['id_country_residence']);
        $query->bindParam(":id_department", $datos['id_department']);
        $query->bindParam(":id_municipality", $datos['id_municipality']);
        $query->bindParam(":direction", $datos['direction']);
        $query->bindParam(":email", $datos['email']);
        $query->bindParam(":landline", $datos['landline']);
        $query->bindParam(":cell_phone", $datos['cell_phone']);
        $query->bindParam(":whattsapp", $datos['whattsapp']);
        $query->bindParam(":marital_status", $datos['marital_status']);
        $query->bindParam(":work_place", $datos['work_place']);
        $query->bindParam(":position", $datos['position']);
        return $query->execute();
        $query->close();
    }
 
    public function actualizarPeople($data){
    }

     /**************************************************************** */
     /* AREA REFERENTE A PROVEEDORES   -----> PROVEEDORES */
     public function list_data_vendors()
     {
         try {
              $sql = "SELECT id, cod, name, tradename, email, contact_2,term, description, direction FROM vendors ORDER BY update_SRV";
              $query = Connection::connect()->prepare($sql);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
     public function listDataVendorsToId($id)
     {
         try {
              $sql = "SELECT id, cod, name, tradename, email,contact, contact_2,term, description, direction FROM vendors WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id", $id);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
     public function insertVendors($datos){
         try {
             $sql = "INSERT INTO vendors (cod, name, tradename, email, contact, contact_2,term, description, direction) 
                             VALUES (:cod, :name, :tradename, :email, :contact, :contact_2, :term, :description, :direction)";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":cod", $datos['cod']);
             $query->bindParam(":name", $datos['name']);
             $query->bindParam(":tradename", $datos['tradename']);
             $query->bindParam(":email", $datos['email']);
             $query->bindParam(":contact", $datos['contact']);
             $query->bindParam(":contact_2", $datos['contact_2']);
             $query->bindParam(":term", $datos['term']);
             $query->bindParam(":description", $datos['description']);
             $query->bindParam(":direction", $datos['direction']);
             return $query->execute();
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
        }  
     }
 
     public function updateVendors($datos){
         try {
             $sql = "UPDATE vendors SET cod = :cod, name = :name, tradename = :tradename, email = :email, contact = :contact, contact_2 = :contact_2, term = :term, description = :description, direction = :direction WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":cod", $datos['cod']);
             $query->bindParam(":name", $datos['name']);
             $query->bindParam(":tradename", $datos['tradename']);
             $query->bindParam(":email", $datos['email']);
             $query->bindParam(":contact", $datos['contact']);
             $query->bindParam(":contact_2", $datos['contact_2']);
             $query->bindParam(":term", $datos['term']);
             $query->bindParam(":description", $datos['description']);
             $query->bindParam(":direction", $datos['direction']);
             $query->bindParam(":id", $datos['id']);
             return $query->execute();
             
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
        }  
     }
 
     public function deleteVendors($id){
         try {
             $sql = "DELETE FROM  vendors WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             return $query->execute();
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
        }  
     }
     /**************************************************************** */


     public function list_vendors_terms()
     {
         try {
              $sql = "SELECT id, medium FROM vendors_terms ORDER BY update_SRV";
              $query = Connection::connect()->prepare($sql);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
 


}



?>