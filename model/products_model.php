<?php 

require  ("../db/connection.php");


class PRODUCTS extends Connection {

    /* PARTE DE LA AREA REFERENTE A GRUPOS E INVENTARIOS   -----> PRODUCTOS */



    public function insertExistences($datos){
     try {
         $sql = "INSERT INTO products_existences (id_product, current_existence ) VALUES (:id_product, :cant)";
         $query = Connection::connect()->prepare($sql);
         $query->bindParam(":cant", $datos['cantidad']);
         $query->bindParam(":id_product", $datos['id_product']);
         return $query->execute();
    } catch (Exception $e) {
         echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
    }  
 }

 public function UpdateExistences($datos){
     try {
         $sql = "UPDATE products_existences SET current_existence  = :cant WHERE id_product = :id_product && id = :id";
         $query = Connection::connect()->prepare($sql);
         $query->bindParam(":cant", $datos['cant']);
         $query->bindParam(":id_product", $datos['id_product']);
         $query->bindParam(":id", $datos['id']);
         return $query->execute();
    } catch (Exception $e) {
         echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
    }  
 }

    
    public function validateCodProduct($cod)
    {
        try {
             $sql = "SELECT id, name FROM products WHERE cod = :cod ";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":cod", $cod);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function mostrarVentasBajo()
    {
        try {
          setlocale(LC_ALL, 'es_ES');
          date_default_timezone_set('America/El_Salvador');
          $fecha_reporte = date("Y-m-d");
             $sql = "SELECT SUM(total_document) as total FROM invoices WHERE DATE = '$fecha_reporte' && id_document = '1'";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function readExistences($id)
    {
        try {
             $sql = "SELECT products_existences.id, products_existences.current_existence, products.name, products.bar_code, products.cod FROM products_existences
             INNER JOIN products ON products_existences.id_product = products.id
              WHERE products_existences.id_product = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function mostrarVentasNormales()
    {
        try {
          setlocale(LC_ALL, 'es_ES');
          date_default_timezone_set('America/El_Salvador');
          $fecha_reporte = date("Y-m-d");
             $sql = "SELECT SUM(total_document) as total FROM invoices WHERE DATE = '$fecha_reporte' && id_document = '2'";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataProducts()
    {
        try {
             $sql = "SELECT products.id, products.cod, bar_code, id_group, products.name, products.description, sale_price, sale_price_1,
             status_product, products_status.name AS status_product_name, products_status.color AS status_product_color,
             products_group.name AS name_group, products_laboratories.name AS laboratorie, location.name AS location, sub_location.name AS sub_location, vendors.name AS proveedor, existencias.current_existence
             FROM products 
             INNER JOIN products_status ON products.status_product = products_status.id
             INNER JOIN products_group ON products.id_group = products_group.id
             INNER JOIN products_laboratories ON products.id_laboratorie = products_laboratories.id
          
             INNER JOIN products_locations as location on  products.id_location = location.id 
             INNER JOIN products_locations as sub_location on products.id_sub_location = sub_location.id 
             INNER JOIN products_existences AS existencias ON products.id = existencias.id_product
             
             
             INNER JOIN vendors ON products.id_vendor = vendors.id
             ORDER BY products.update_SRV DESC";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataProductsToId($id)
    {
        try {
             $sql = "SELECT id, cod,bar_code, id_group, name, description, sale_price, sale_price_1
             FROM products 
             WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataProductSearch($element)
    {
        try {
             $element = "%$element%";
             $sql = "SELECT products.id, products.cod, bar_code, id_group, products.name, products.description, sale_price, sale_price_1,
             status_product, products_status.name AS status_product_name, products_status.color AS status_product_color,
             products_group.name AS name_group, products_laboratories.name AS laboratorie, products_locations.name AS location, products.sub_location AS sub_location
             FROM products 
             INNER JOIN products_status ON products.status_product = products_status.id
             INNER JOIN products_group ON products.id_group = products_group.id
             INNER JOIN products_laboratories ON products.id_laboratorie = products_laboratories.id
             INNER JOIN products_locations ON products.id_location = products_locations.id 
             WHERE products.description LIKE :element OR products.name LIKE :element ";

             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":element", $element);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataProductItem($element)
    {
        try {

             $sql = "SELECT products.id, products.cod, bar_code, id_group, products.name, products.description, sale_price, sale_price_1,
             status_product, products_status.name AS status_product_name, products_status.color AS status_product_color,
             products_group.name AS name_group, products_laboratories.name AS laboratorie, products_locations.name AS location, products.sub_location AS sub_location
             FROM products 
             INNER JOIN products_status ON products.status_product = products_status.id
             INNER JOIN products_group ON products.id_group = products_group.id
             INNER JOIN products_laboratories ON products.id_laboratorie = products_laboratories.id
             INNER JOIN products_locations ON products.id_location = products_locations.id 
             WHERE products.cod = :element OR products.bar_code = :element ";


             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":element", $element);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataProductItemPresentations($element)
    {
        try {

             $sql = "SELECT products.id, products.cod, bar_code, id_group, products.name, products.description, sale_price, sale_price_1,
             status_product, products_status.name AS status_product_name, products_status.color AS status_product_color,
             products_group.name AS name_group, products_laboratories.name AS laboratorie, products_locations.name AS location, products.sub_location AS sub_location
             FROM products 
             INNER JOIN products_status ON products.status_product = products_status.id
             INNER JOIN products_group ON products.id_group = products_group.id
             INNER JOIN products_laboratories ON products.id_laboratorie = products_laboratories.id
             INNER JOIN products_locations ON products.id_location = products_locations.id 
             WHERE products.cod = :element OR products.bar_code = :element ";


             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":element", $element);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }




    

    public function listDataProductsPresentations($id)
    {
        try {
             $sql = "SELECT 
             products_presentations.id, CONCAT_WS(' ', products_presentations.name ) AS presentation, products_presentations.factor, products_presentations.sale_price, products_presentations.precio_presS 
             FROM products_presentations 
             INNER JOIN products ON products_presentations.id = products.id
             WHERE products_presentations.id_product = :id ";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function searchProductName($id)
    {
        try {
             $sql = "SELECT id, cod, name FROM products WHERE id = :id ";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }

     
        
    }


    







    public function listDataToBarCode($bar_code){
         try {
               $sql = "SELECT products.id, products.cod, products.name,cost, sale_price, sale_price_1, presentation          
               FROM products 
               WHERE bar_code = :bar_code || cod = :bar_code";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":bar_code", $bar_code);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);       
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
    }

    public function listDataToBarCodePres($bar_code){
     try {
           $sql = "SELECT id_product, name, factor, sale_price, precio_presS FROM products_presentations WHERE barcode = :bar_code";
           $query = Connection::connect()->prepare($sql);
           $query->bindParam(":bar_code", $bar_code);
           $query->execute();
           return $query->fetchAll(PDO::FETCH_ASSOC);       
      } catch (Exception $e) {
           echo "Ocurrio un error en la consulta: " . $e->getMessage();
      }
}


    public function listDataToName($name){
     try {
          $name = "%$name%";
           $sql = "SELECT products.id, products.cod, products.name,products.cost, sale_price, sale_price_1, presentation , products.description , products_laboratories.name AS laboratorie, existencias.current_existence      
           FROM products
           INNER JOIN products_laboratories ON products.id_laboratorie = products_laboratories.id
           INNER JOIN products_existences AS existencias ON products.id = existencias.id_product
           WHERE products.name LIKE :name or products.description LIKE :name";
           $query = Connection::connect()->prepare($sql);
           $query->bindParam(":name", $name);
           $query->execute();
           return $query->fetchAll(PDO::FETCH_ASSOC);       
      } catch (Exception $e) {
           echo "Ocurrio un error en la consulta: " . $e->getMessage();
      }
}


    

    public function listDataToPresentation($id){
     try {
           $sql = "SELECT COUNT(*) AS total FROM products_presentations WHERE id_product = :id";
           $query = Connection::connect()->prepare($sql);
           $query->bindParam(":id", $id);
           $query->execute();
           return $query->fetchAll(PDO::FETCH_ASSOC);       
      } catch (Exception $e) {
           echo "Ocurrio un error en la consulta: " . $e->getMessage();
      }
}





    

    public function listDataProductToId($id)
    {
        try {
             $sql = "SELECT id, cod, bar_code, id_rub, id_group, id_subgroup, 
               id_vendor, id_laboratorie, id_location,id_sub_location, id_presentation,
               name, sale_price, sale_price_1, cost, wholesalers_price,
               description, status_product, presentation, model, version,
               stk_min, stk_med, stk_max,include_IVA FROM products WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function insertProduct($datos){
        try {
            $sql = "INSERT INTO products 
            (cod, bar_code, id_rub, id_group, id_subgroup, id_vendor, id_laboratorie, id_location,id_sub_location, id_presentation,name, sale_price, sale_price_1, 
            cost, wholesalers_price, description, status_product, presentation, model, version, stk_min, stk_med, stk_max,include_IVA) 
                    VALUES (:cod, :bar_code, :id_rub, :id_group, :id_subgroup, :id_vendor, :id_laboratorie, :id_location, :id_sub_location, :id_presentation,:name, :sale_price, :sale_price_1, 
            :cost, :wholesalers_price, :description, :status_product, :presentation, :model, :version, :stk_min, :stk_med, :stk_max, :include_IVA)";
            $conn =  ConnectionTransaction::connectTransaction();
            $conn ->beginTransaction();
            $query = $conn->prepare($sql);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":bar_code", $datos['bar_code']);
            $query->bindParam(":id_rub", $datos['id_rub']);
            $query->bindParam(":id_group", $datos['id_group']);
            $query->bindParam(":id_subgroup", $datos['id_subgroup']);
            $query->bindParam(":id_vendor", $datos['id_vendor']);
            $query->bindParam(":id_laboratorie", $datos['id_laboratorie']);
            $query->bindParam(":id_location", $datos['id_location']);
            $query->bindParam(":id_sub_location", $datos['id_sub_location']);
            $query->bindParam(":id_presentation", $datos['id_presentation']);
            $query->bindParam(":name", $datos['name']);
            $query->bindParam(":sale_price", $datos['sale_price']);
            $query->bindParam(":sale_price_1", $datos['sale_price_1']);
            $query->bindParam(":cost", $datos['cost']);
            $query->bindParam(":wholesalers_price", $datos['wholesalers_price']);
            $query->bindParam(":description", $datos['description']);
            $query->bindParam(":status_product", $datos['status_product']);
            $query->bindParam(":presentation", $datos['presentation']);
            $query->bindParam(":model", $datos['model']);
            $query->bindParam(":version", $datos['version']);
            $query->bindParam(":stk_min", $datos['stk_min']);
            $query->bindParam(":stk_med", $datos['stk_med']);
            $query->bindParam(":stk_max", $datos['stk_max']);
            $query->bindParam(":include_IVA", $datos['include_IVA']);
            $query->execute();
            $id_product = $conn->lastInsertId();  

            $sql = "INSERT INTO products_existences (id_product) VALUES (:id_product) ";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id_product", $id_product);
            $query->execute();

            
            $result = $conn->commit();
            $res = (array('error' => false, 'id' => $id_product , 'msg' => "Se ha registrado el producto")); 
            return $res; 
  

       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }

    public function updateProduct($datos){
        try {
            $sql = "UPDATE products SET cod = :cod , bar_code = :bar_code, id_rub = :id_rub, id_group = :id_group, id_subgroup = :id_subgroup, 
            id_vendor = :id_vendor, id_laboratorie = :id_laboratorie, id_location = :id_location,id_sub_location = :id_sub_location, id_presentation = :id_presentation,name = :name,
            sale_price = :sale_price, sale_price_1 = :sale_price_1, cost = :cost, wholesalers_price = :wholesalers_price, description = :description,
            status_product = :status_product, presentation = :presentation, model = :model, version = :version, stk_min = :stk_min, stk_med = :stk_med, 
            stk_max = :stk_max,include_IVA = :include_IVA WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":bar_code", $datos['bar_code']);
            $query->bindParam(":id_rub", $datos['id_rub']);
            $query->bindParam(":id_group", $datos['id_group']);
            $query->bindParam(":id_subgroup", $datos['id_subgroup']);
            $query->bindParam(":id_vendor", $datos['id_vendor']);
            $query->bindParam(":id_laboratorie", $datos['id_laboratorie']);
            $query->bindParam(":id_location", $datos['id_location']);
            $query->bindParam(":id_sub_location", $datos['id_sub_location']);
            $query->bindParam(":id_presentation", $datos['id_presentation']);
            $query->bindParam(":name", $datos['name']);
            $query->bindParam(":sale_price", $datos['sale_price']);
            $query->bindParam(":sale_price_1", $datos['sale_price_1']);
            $query->bindParam(":cost", $datos['cost']);
            $query->bindParam(":wholesalers_price", $datos['wholesalers_price']);
            $query->bindParam(":description", $datos['description']);
            $query->bindParam(":status_product", $datos['status_product']);
            $query->bindParam(":presentation", $datos['presentation']);
            $query->bindParam(":model", $datos['model']);
            $query->bindParam(":version", $datos['version']);
            $query->bindParam(":stk_min", $datos['stk_min']);
            $query->bindParam(":stk_med", $datos['stk_med']);
            $query->bindParam(":stk_max", $datos['stk_max']);
            $query->bindParam(":include_IVA", $datos['include_IVA']);
            $query->bindParam(":id", $datos['id']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
       }  
    }

    public function deleteProduct($id){
        try {
            $sql = "DELETE FROM  products WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id", $id);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }

    public function generateCodProduct($table){
        try {
          $sql = "SELECT max(id) AS cod FROM $table";
          $query = Connection::connect()->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
          $query->close();
        } catch (Exception $e) {
          echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
        }  
     }


 


    


    /* PARTE DE LA AREA REFERENTE A GRUPOS E INVENTARIOS   -----> GRUPOS */
    public function list_data_gruops()
    {
        try {
             $sql = "SELECT id,id_rub, cod, name, description FROM products_group ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


    public function list_moneybox()
    {
        try {
             $sql = "SELECT id, name FROM money_box ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    
    public function list_tipeof_pay()
    {
        try {
             $sql = "SELECT id, cod,name FROM sys_tipeof_pay ORDER BY id";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


    public function list_documents($type)
    {
        try {
             $sql = "SELECT id, cod,name FROM sys_documents WHERE type = :type ORDER BY id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":type", $type);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


    


    

    

    public function listDataGroupToId($id)
    {
        try {
             $sql = "SELECT id, id_rub, cod, name, description FROM products_group WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function insertGroup($datos){
        try {
            $sql = "INSERT INTO products_group (id_rub,cod,name,description) 
                            VALUES (:id_rub,:cod, :name, :description)";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id_rub", $datos['id_rub']);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":name", $datos['name']);
            $query->bindParam(":description", $datos['description']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }

    public function updateGroup($datos){
        try {
            $sql = "UPDATE products_group SET id_rub = :id_rub, cod = :cod, name = :name, description = :description WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id_rub", $datos['id_rub']);
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

    public function deleteGroup($id){
        try {
            $sql = "DELETE FROM  products_group WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id", $id);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }



     /* PARTE DE LA AREA REFERENTE A RUBROS E INVENTARIOS   -----> RUBROS */
     public function list_data_rubs()
     {
         try {
              $sql = "SELECT id, cod, name, description FROM products_rub ORDER BY update_SRV";
              $query = Connection::connect()->prepare($sql);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
     public function listDataRubToId($id)
     {
         try {
              $sql = "SELECT id, cod, name, description FROM products_rub WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id", $id);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
     public function insertRub($datos){
         try {
             $sql = "INSERT INTO products_rub (cod,name,description) 
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
 
     public function updateRub($datos){
         try {
             $sql = "UPDATE products_rub SET cod = :cod, name = :name, description = :description WHERE id = :id";
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
 
     public function deleteRub($id){
         try {
             $sql = "DELETE FROM  products_rub WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             return $query->execute();
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
        }  
     }




     /* PARTE DE LA AREA REFERENTE A GRUPOS E INVENTARIOS   -----> SUBGRUPOS */
    public function list_data_subgruops()
    {
        try {
             $sql = "SELECT products_subgroup.id AS id,products_subgroup.cod AS cod, products_subgroup.NAME AS name, id_group, products_group.name AS grupo 
             FROM products_subgroup
             INNER JOIN products_group ON products_subgroup.id_group = products_group.id
             ORDER BY products_subgroup.update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function listDataSubGroupToId($id)
    {
        try {
             $sql = "SELECT id, id_group, cod, name FROM products_subgroup WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function insertSubGroup($datos){
        try {
            $sql = "INSERT INTO products_subgroup (id_group,cod,name) 
                            VALUES (:id_group,:cod, :name)";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id_group", $datos['id_group']);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":name", $datos['name']);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }

    public function updateSubGroup($datos){
        try {
            $sql = "UPDATE products_subgroup SET id_group = :id_group, cod = :cod, name = :name WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id_group", $datos['id_group']);
            $query->bindParam(":cod", $datos['cod']);
            $query->bindParam(":name", $datos['name']);
            $query->bindParam(":id", $datos['id']);
            return $query->execute();
            
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
       }  
    }

    public function deleteSubGroup($id){
        try {
            $sql = "DELETE FROM  products_subgroup WHERE id = :id";
            $query = Connection::connect()->prepare($sql);
            $query->bindParam(":id", $id);
            return $query->execute();
            $query->close();
       } catch (Exception $e) {
            echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
       }  
    }


     /* PARTE DE LA AREA REFERENTE A LABORATORIOS DE INVENTARIOS   -----> LABORATORIOS */
     public function list_data_laboratories()
     {
         try {
              $sql = "SELECT id, cod, name, description FROM products_laboratories ORDER BY update_SRV";
              $query = Connection::connect()->prepare($sql);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
     public function listDataLaboratoriesToId($id)
     {
         try {
              $sql = "SELECT id, cod, name, description FROM products_laboratories WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id", $id);
              $query->execute();
              return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
              echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
         
     }
 
     public function insertLaboratories($datos){
         try {
             $sql = "INSERT INTO products_laboratories (cod, name, description) 
                             VALUES (:cod, :name, :description)";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":description", $datos['description']);
             $query->bindParam(":cod", $datos['cod']);
             $query->bindParam(":name", $datos['name']);
             return $query->execute();
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
        }  
     }
 
     public function updateLaboratories($datos){
         try {
             $sql = "UPDATE products_laboratories SET cod = :cod, name = :name, description = :description  WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":description", $datos['description']);
             $query->bindParam(":cod", $datos['cod']);
             $query->bindParam(":name", $datos['name']);
             $query->bindParam(":id", $datos['id']);
             return $query->execute();
             
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
        }  
     }
 
     public function deleteLaboratories($id){
         try {
             $sql = "DELETE FROM  products_laboratories WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             return $query->execute();
             $query->close();
        } catch (Exception $e) {
             echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
        }  
     }
 


      /* PARTE DE LA AREA REFERENTE A UBICACIONES DE INVENTARIOS   -----> UBICACIONES */
      public function list_data_locations()
      {
          try {
               $sql = "SELECT id, cod, name, description FROM products_locations ORDER BY update_SRV";
               $query = Connection::connect()->prepare($sql);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
          
      }
  
      public function listDataLocationsToId($id)
      {
          try {
               $sql = "SELECT id, cod, name, description FROM products_locations WHERE id = :id";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":id", $id);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
          
      }

      
  
      public function insertLocations($datos){
          try {
              $sql = "INSERT INTO products_locations (cod, name, description) 
                              VALUES (:cod, :name, :description)";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":description", $datos['description']);
              $query->bindParam(":cod", $datos['cod']);
              $query->bindParam(":name", $datos['name']);
              return $query->execute();
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
         }  
      }
  
      public function updateLocations($datos){
          try {
              $sql = "UPDATE products_locations SET cod = :cod, name = :name, description = :description  WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":description", $datos['description']);
              $query->bindParam(":cod", $datos['cod']);
              $query->bindParam(":name", $datos['name']);
              $query->bindParam(":id", $datos['id']);
              return $query->execute();
              
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
         }  
      }
  
      public function deleteLocations($id){
          try {
              $sql = "DELETE FROM  products_locations WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id", $id);
              return $query->execute();
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
         }  
      }



      /* PARTE DE LA AREA REFERENTE A LOTES DE INVENTARIOS   -----> LOTES */
      public function listDataLots($id)
      {
          try {
               $sql = "SELECT id,lot, cant, date_lote, date_expiration FROM products_lot WHERE id_produt = :id";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":id", $id);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
          
      }
  
      public function listDataLotsToId($id)
      {
          try {
               $sql = "SELECT id,lot, cant, date_lote, date_expiration FROM products_lot WHERE id = :id";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":id", $id);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
          
      }
  
      public function insertLots($datos){
          try {
              $sql = "INSERT INTO products_lot (id_produt,lot, cant, date_lote, date_expiration) 
                              VALUES (:id_produt,:lot, :cant, :date_lote, :date_expiration)";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id_produt", $datos['id_produt']);
              $query->bindParam(":cant", $datos['cant']);
              $query->bindParam(":lot", $datos['lot']);
              $query->bindParam(":date_lote", $datos['date_lote']);
              $query->bindParam(":date_expiration", $datos['date_expiration']);
              return $query->execute();
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
         }  
      }
  
      public function updateLots($datos){
          try {
              $sql = "UPDATE products_lot SET lot = :lot, cant = :cant, date_lote = :date_lote, date_expiration = :date_expiration  WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":cant", $datos['cant']);
              $query->bindParam(":lot", $datos['lot']);
              $query->bindParam(":date_lote", $datos['date_lote']);
              $query->bindParam(":date_expiration", $datos['date_expiration']);
              $query->bindParam(":id", $datos['id']);
              return $query->execute();
              
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
         }  
      }
  
      public function deleteLots($id){
          try {
              $sql = "DELETE FROM  products_lot WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id", $id);
              return $query->execute();
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
         }  
      }




      /* PARTE DE LA AREA REFERENTE A LOTES DE INVENTARIOS   -----> LOTES */
      public function listDataPresentations($id)
      {
          try {
               $sql = "SELECT id,barcode,name, factor, sale_price, precio_presS FROM products_presentations WHERE id_product = :id";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":id", $id);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
          
      }
  
      public function listDataPresentationsToId($id)
      {
          try {
               $sql = "SELECT id,barcode, name, factor, sale_price,precio_presS FROM products_presentations WHERE id = :id";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":id", $id);
               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
          } catch (Exception $e) {
               echo "Ocurrio un error en la consulta: " . $e->getMessage();
          }
          
      }
  
      public function insertPresentations($datos){
          try {
              $sql = "INSERT INTO products_presentations (id_product,barcode,name, factor,precio_presS, sale_price) 
                              VALUES (:id_produt,:barcode, :name, :factor,:precio_presS, :sale_price)";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id_produt", $datos['id_produt']);
              $query->bindParam(":barcode", $datos['barcode']);
              $query->bindParam(":name", $datos['name']);
              $query->bindParam(":factor", $datos['factor']);
              $query->bindParam(":precio_presS", $datos['precio_presS']);
              $query->bindParam(":sale_price", $datos['sale_price']);
              return $query->execute();
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
         }  
      }


      public function updatePresentations($datos){
          try {
              $sql = "UPDATE products_presentations SET barcode = :barcode, name = :name, factor = :factor, precio_presS = :precio_presS, sale_price = :sale_price  WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":name", $datos['name']);
              $query->bindParam(":barcode", $datos['barcode']);
              $query->bindParam(":factor", $datos['factor']);
              $query->bindParam(":precio_presS", $datos['precio_presS']);
              $query->bindParam(":sale_price", $datos['sale_price']);
              $query->bindParam(":id", $datos['id']);
              return $query->execute();
              
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
         }  
      }
  
    
  
      public function deletePresentations($id){
          try {
              $sql = "DELETE FROM  products_presentations WHERE id = :id";
              $query = Connection::connect()->prepare($sql);
              $query->bindParam(":id", $id);
              return $query->execute();
              $query->close();
         } catch (Exception $e) {
              echo "Ocurrio un error al momento de grabar: " . $e->getMessage();
         }  
      }
  
 
 



    /************************************************************************************** */
    public function list_groups()
    {
        try {
             $sql = "SELECT id, name FROM products_group ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "An error occurred in the data validation: " . $e->getMessage();
        }
        
    }

    public function list_status(){
     try {
          $sql = "SELECT id, name, color FROM products_status ORDER BY create_SRV";
          $query = Connection::connect()->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "An error occurred in the data validation: " . $e->getMessage();
     }
    }

    public function list_rubs(){
     try {
          $sql = "SELECT id, name FROM products_rub ORDER BY create_SRV";
          $query = Connection::connect()->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
          echo "An error occurred in the data validation: " . $e->getMessage();
     }
    }

    public function list_vendors()
    {
        try {
             $sql = "SELECT id, tradename FROM vendors ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_laboratories()
    {
        try {
             $sql = "SELECT id, name FROM products_laboratories ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_locations()
    {
        try {
             $sql = "SELECT id, name FROM products_locations ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_sub_locations()
    {
        try {
             $sql = "SELECT id, name FROM products_locations ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_subgroupToGroup($id)
    {
        try {
             $sql = "SELECT id, name FROM products_subgroup WHERE id_group = :id ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_cashiers()
    {
        try {
             $sql = "SELECT id, name FROM cashiers";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_cashier()
    {
        try {
             $sql = "SELECT employees.id, system_people.name FROM employees
                    INNER JOIN system_people ON employees.id_people = system_people.id";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }




    

    public function list_groupsToRub($id)
    {
        try {
             $sql = "SELECT id, name FROM products_group WHERE id_rub = :id ORDER BY update_SRV";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


    public function list_clients()
    {
        try {
             $sql = "SELECT system_clients.id, system_clients.cod , CONCAT_WS(' ', system_people.name, system_people.name2, system_people.surname, system_people.surname2) AS name
                    FROM system_clients
                    INNER JOIN system_people ON system_clients.id_people = system_people.id";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function list_proveedores()
    {
        try {
             $sql = "SELECT id, tradename AS name FROM vendors";
             $query = Connection::connect()->prepare($sql);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


    public function list_data_invoices(){
         try {
               setlocale(LC_ALL, 'es_ES');
               date_default_timezone_set('America/El_Salvador');
               $fechaHoy = date("Y-m-d");
              $sql = "SELECT invoices.id,
              invoices.number, sys_documents.name, date(invoices.date) as date, invoices.id_document, 
              invoices.total_document, invoices.total_document_desc, 
              invoices.desc_recipe, invoices.desc_invoice_plus, invoices.update_SRV,
              users_profile.alias
              FROM invoices
              INNER JOIN sys_documents ON invoices.id_document = sys_documents.id
              INNER JOIN users ON invoices.id_seller = users.id
              INNER JOIN users_profile ON users.id =users_profile.id WHERE  date(invoices.date) = :dates";
               $query = Connection::connect()->prepare($sql);
           $query->bindParam(":dates", $fechaHoy);

               $query->execute();
               return $query->fetchAll(PDO::FETCH_ASSOC);
         } catch (Exception $e) {
          echo "Ocurrio un error en la consulta: " . $e->getMessage();
         }
    }

    public function list_data_invoicesWhere($id){
     try {
          $sql = "SELECT invoices.id,
          invoices.number, sys_documents.name, date(invoices.date) as date, invoices.id_document, 
          invoices.total_document, invoices.total_document_desc, 
          invoices.desc_recipe, invoices.desc_invoice_plus, invoices.update_SRV,
          users_profile.alias
          FROM invoices
          INNER JOIN sys_documents ON invoices.id_document = sys_documents.id
          INNER JOIN users ON invoices.id_seller = users.id
          INNER JOIN users_profile ON users.id =users_profile.id WHERE invoices.number = :number";
           $query = Connection::connect()->prepare($sql);
           $query->bindParam(":number", $id);
           $query->execute();
           return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
      echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }
}


public function list_data_invoiceDetails($id){
     try {
          $sql = "SELECT name, presentation, cant, factor, sale_price, sale_price_suggested FROM invoice_details WHERE id_invoice = :id";
           $query = Connection::connect()->prepare($sql);
           $query->bindParam(":id", $id);
           $query->execute();
           return $query->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {
      echo "Ocurrio un error en la consulta: " . $e->getMessage();
     }
}




    


    public function obtenerDataDocument($id)
    {
        try {
             $sql = " SELECT impuesto,  current_range + 1 AS rango, current_correlative + 1 AS correlativo FROM sys_documents WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }

    public function obtenerDataDocument_error($id)
    {
        try {
             $sql = " SELECT impuesto,  current_range + 2 AS rango, current_correlative + 1 AS correlativo FROM sys_documents WHERE id = :id";
             $query = Connection::connect()->prepare($sql);
             $query->bindParam(":id", $id);
             $query->execute();
             return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


    

    public function updateCostProduct($datos){
     try {
         $sql = "UPDATE products SET cost = :cost WHERE id = :id";
         $query = Connection::connect()->prepare($sql);
         $query->bindParam(":id", $datos['id']);
         $query->bindParam(":cost", $datos['cost']);
         return $query->execute();
     
         $query->close();
    } catch (Exception $e) {
         echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
    }  
 }

 
 public function updatePrecioProduct($datos){
     try {
         $sql = "UPDATE products SET sale_price_1 = :sale_price WHERE id = :id";
         $query = Connection::connect()->prepare($sql);
         $query->bindParam(":id", $datos['id']);
         $query->bindParam(":sale_price", $datos['precio']);
         return $query->execute();
     
         $query->close();
    } catch (Exception $e) {
         echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
    }  
 }


 public function updatePrecioSugProduct($datos){
     try {
         $sql = "UPDATE products SET sale_price = :sale_price WHERE id = :id";
         $query = Connection::connect()->prepare($sql);
         $query->bindParam(":id", $datos['id']);
         $query->bindParam(":sale_price", $datos['precio']);
         return $query->execute();
     
         $query->close();
    } catch (Exception $e) {
         echo "Ocurrio un error al momento de actualizar: " . $e->getMessage();
    }  
 }


 
}




class INVOICE extends ConnectionTransaction {

     public function insertInvoice($data, $details){
          try {

               setlocale(LC_ALL, 'es_ES');
               date_default_timezone_set('America/El_Salvador');
               $fechaHoy = date("d/m/y  H:i:s A");
               /* VARIABLES DEL ENCABEZADO DE LA VENTA */
               $number = $data['number_transacction'];
               $id_document = $data['id_document'];
               $id_casher = $data['id_casher'];
               $total_documentDesc = $data['total_documentDesc'];
               $date = $data['date'];
               $id_cliente = $data['id_client'];
               $id_seller = $data['id_seller'];
               $id_typeofpay = $data['id_tyofpay'];
               $mount = $data['mount'];
               $cash = $data['cash'];
               $state = $data['state'];
               $total_document = $data['total_document'];
               $desc_receta = $data['desc_receta'];
               $desc_compras = $data['desc_compras'];
               $start_date = $date ;
               $final_date = $fechaHoy;


               $invoice_query = "INSERT INTO invoices (number, date,id_document, id_client, id_casher, id_seller, id_typeofpay, state, total_document,total_document_desc,desc_recipe, desc_invoice_plus,mount, cash, start_date, final_date) 
               values(:number, :date, :id_document, :id_client, :id_casher, :id_seller, :id_typeofpay, :state, :total_document,:total_document_desc, :desc_recipe,:desc_invoice_plus, :mount, :cash, :start_date, :final_date)";

          
               $conn =  ConnectionTransaction::connectTransaction();
               $conn ->beginTransaction();
               $query = $conn->prepare($invoice_query);
               $query->bindParam(":number", $number);
               $query->bindParam(":date", $date);
               $query->bindParam(":id_client", $id_cliente);
               $query->bindParam(":id_document", $id_document);
               $query->bindParam(":id_casher", $id_casher);
               $query->bindParam(":total_document_desc", $total_documentDesc);
               $query->bindParam(":desc_recipe", $desc_receta);
               $query->bindParam(":desc_invoice_plus", $desc_compras);
               $query->bindParam(":id_seller", $id_seller);
               $query->bindParam(":id_typeofpay", $id_typeofpay);
               $query->bindParam(":state",$state);
               $query->bindParam(":total_document", $total_document);
               $query->bindParam(":mount", $mount);
               $query->bindParam(":cash", $cash);
               $query->bindParam(":start_date", $start_date);
               $query->bindParam(":final_date", $final_date);
               $query->execute();
               $id_invoice = $conn->lastInsertId();  


               /* GRABANDO EL DETALLE DE LA VENTA  */
               $invoice_details_query = "INSERT INTO invoice_details (id_invoice, id_product, name, presentation, cant,factor, sale_price, sale_price_suggested) VALUES";

               for ($i=0; $i < count($details['id_product']);) { 

                    $id_product = $details['id_product'][$i];
                    $name = $details['name'][$i];
                    $presentation = $details['presentation'][$i];
                    $cant =  $details['cant'][$i];
                    $factor = $details['factor'][$i];
                    $sale_price = $details['sale_price'][$i];
                    $price_sug =  $details['sale_price_suggested'][$i];
                    $invoice_details_query .= "('$id_invoice','$id_product','$name','$presentation','$cant','$factor','$sale_price','$price_sug')";
                    $i++;

                    if ($i < count($details['id_product'])) {
                         $invoice_details_query .= ",";
                    }else{

                    }

                         /* DESCARGO DE INVENTARIO */
                         $sql = "SELECT current_existence FROM products_existences WHERE id_product = :id_product";
                         $query = Connection::connect()->prepare($sql);
                         $query->bindParam(":id_product", $id_product);
                         $query->execute();
                         $can_tt = $query->fetch();
               
                         $can_existe = floatval($can_tt['current_existence']);
                         $cant_factor = floatval($factor);
               
                 
                         $cant_final = $can_existe  - $cant_factor;
               
                         $sql = "UPDATE products_existences SET current_existence = :cant WHERE id_product = :id_product";
                         $query = Connection::connect()->prepare($sql);
                         $query->bindParam(":id_product", $id_product);
                         $query->bindParam(":cant", $cant_final);
                        $query->execute();
                         
                    
               }

               $query = $conn->prepare($invoice_details_query);
               $query->execute(); 

               $sql = "UPDATE sys_documents SET current_correlative = :current_correlative WHERE id = :id ";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":current_correlative", $number);
               $query->bindParam(":id", $id_document);
               $query->execute();


               $result = $conn->commit();
               $res = (array('error' => false, 'id' => $id_invoice , 'msg' => "Se ha registrado la transaccion")); 
              return $res; 
         
         } catch (PDOException $e) {
               $result = $conn->rollback();
               $res = (array('error' => true, 'id' => '' , 'msg' => "Ocurrio un error al momento de grabar: " . $e->getMessage()));
               return $res;
         }  
      }




      
    public function discount_inventory($id_product, $factor)
    {
        try {
          $sql = "SELECT current_existence FROM products_existences WHERE id_product = :id_product";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":id_product", $id_product);
          $query->execute();
          $can_tt = $query->fetch();

          $can_existe = intval($can_tt['current_existence']);
          $cant_factor = intval($factor);

  
          $cant_final = $can_existe  - $cant_factor;

          $sql = "UPDATE products_existences SET current_existence = :cant WHERE id_product = :id_product";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":id_product", $id_product);
          $query->bindParam(":cant", $cant_final);
          return $query->execute();
          
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }


  


 
}










class QUOTES extends ConnectionTransaction {

     public function insertQuotesHead($data, $details){
          try {
               setlocale(LC_ALL, 'es_ES');
               date_default_timezone_set('America/El_Salvador');
               $fechaHoy = date("d/m/y  H:i:s A");
               /* VARIABLES DEL ENCABEZADO DE LA VENTA */
               $number = $data['number_transacction'];
               $number_of_document = $data['number_of_document'];
               $date = $data['date'];
               $id_seller = $data['id_seller'];
               $id_document = $data['id_document'];
               $id_typeofpay = $data['id_tyofpay'];
               $state = $data['state'];
               $total_document = $data['total_document'];
               $start_date = $date ;
               $final_date = $data['final_date'];



               $quotes_query = "INSERT INTO quotes (number, number_of_document, date, id_seller,id_document, id_typeofpay, state, total_document, start_date, final_date) 
               values(:number, :number_of_document, :date, :id_seller, :id_document, :id_typeofpay, :state, :total_document, :start_date, :final_date)";

          
               $conn =  ConnectionTransaction::connectTransaction();
               $conn ->beginTransaction();
               $query = $conn->prepare($quotes_query);
               $query->bindParam(":number", $number);
               $query->bindParam(":number_of_document", $number_of_document);
               $query->bindParam(":date", $date);
               $query->bindParam(":id_seller", $id_seller);
               $query->bindParam(":id_document", $id_document);
               $query->bindParam(":id_typeofpay", $id_typeofpay);
               $query->bindParam(":state",$state);
               $query->bindParam(":total_document", $total_document);
               $query->bindParam(":start_date", $start_date);
               $query->bindParam(":final_date", $final_date);
               $query->execute();
               $id_quotes = $conn->lastInsertId();  


               /* GRABANDO EL DETALLE DE LA VENTA  */
               $invoice_details_quotes = "INSERT INTO quotes_details (id_quotes, id_product, name, presentation, cant,factor, sale_price, sale_price_suggested) VALUES";

               for ($i=0; $i < count($details['id_product']);) { 

                    $id_product = $details['id_product'][$i];
                    $name = $details['name'][$i];
                    $presentation = $details['presentation'][$i];
                    $cant =  $details['cant'][$i];
                    $factor = $details['factor'][$i];
                    $sale_price = $details['sale_price'][$i];
                    $price_sug =  $details['sale_price_suggested'][$i];
                    $cost = $details['costo'][$i]; 
                    $invoice_details_quotes .= "('$id_quotes','$id_product','$name','$presentation','$cant','$factor','$sale_price','$price_sug')";
                    $i++;

                    if ($i < count($details['id_product'])) {
                         $invoice_details_quotes .= ",";
                    }else{

                    }

                         /* DESCARGO DE INVENTARIO */
                         $sql = "SELECT current_existence FROM products_existences WHERE id_product = :id_product";
                         $query = Connection::connect()->prepare($sql);
                         $query->bindParam(":id_product", $id_product);
                         $query->execute();
                         $can_tt = $query->fetch();
               
                         $can_existe = floatval($can_tt['current_existence']);
                         $cant_factor = floatval($factor);
               
                 
                         $cant_final = $can_existe  + $cant_factor;
               
                         $sql = "UPDATE products_existences SET current_existence = :cant WHERE id_product = :id_product";
                         $query = Connection::connect()->prepare($sql);
                         $query->bindParam(":id_product", $id_product);
                         $query->bindParam(":cant", $cant_final);
                        $query->execute();


                    
                         
                    
               }

               $query = $conn->prepare($invoice_details_quotes);
               $query->execute(); 

               $sql = "UPDATE sys_documents SET current_correlative = :current_correlative WHERE id = :id ";
               $query = Connection::connect()->prepare($sql);
               $query->bindParam(":current_correlative", $number);
               $query->bindParam(":id", $id_document);
               $query->execute();


               


               $result = $conn->commit();
               $res = (array('error' => false, 'id' => $id_quotes , 'msg' => "Se ha registrado la transaccion")); 
              return $res; 
         
         } catch (PDOException $e) {
               $result = $conn->rollback();
               $res = (array('error' => true, 'id' => '' , 'msg' => "Ocurrio un error al momento de grabar: " . $e->getMessage()));
               return $res;
         }  
      }




      
    public function aument_inventory($id_product, $factor)
    {
        try {
          $sql = "SELECT current_existence FROM products_existences WHERE id_product = :id_product";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":id_product", $id_product);
          $query->execute();
          $can_tt = $query->fetch();

          $can_existe = intval($can_tt['current_existence']);
          $cant_factor = intval($factor);

  
          $cant_final = $can_existe  - $cant_factor;

          $sql = "UPDATE products_existences SET current_existence = :cant WHERE id_product = :id_product";
          $query = Connection::connect()->prepare($sql);
          $query->bindParam(":id_product", $id_product);
          $query->bindParam(":cant", $cant_final);
          return $query->execute();
          
        } catch (Exception $e) {
             echo "Ocurrio un error en la consulta: " . $e->getMessage();
        }
        
    }
}




?>