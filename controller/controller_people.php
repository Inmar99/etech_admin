<?php 

session_start();
require  ("../model/people_model.php"); 

/* Get var by POST to execute an action  */
$action_perform = $_POST['action'];

if ($action_perform == "listPeople") {
    echo json_encode(PEOPLES::list_data());

}else if($action_perform == "list_data_clients"){
    echo json_encode(PEOPLES::list_data_clients());

}else if($action_perform == "is_client"){
    $id = $_POST['id'];
    echo json_encode(PEOPLES::is_client($id));
   
}else if($action_perform == "list_cot"){
    echo json_encode(PEOPLES::list_cot());
   
}else if($action_perform == "insert_client"){
    $id = $_POST['id'];
    echo json_encode(PEOPLES::insert_client($id));
    

}else if ($action_perform == "list_countries") {
    echo json_encode(PEOPLES::list_countries());
    
}else if ($action_perform == "list_departaments") {

    $id_country = $_POST['id_country'];
    echo json_encode(PEOPLES::list_departaments($id_country));

}else if ($action_perform == "list_municipalities") {

    $id_departament = $_POST['id_departament'];
    echo json_encode(PEOPLES::list_municipalities($id_departament));

}else if($action_perform == "get_nationality"){

    $id_country = $_POST['id_country'];
    echo json_encode(PEOPLES::get_nationality($id_country));

   
    
}else if($action_perform == "get_person_profile"){

    $id = $_POST['id'];
    echo json_encode(PEOPLES::get_person_profile($id));

    
    
}else if($action_perform == "get_person_profile_history"){

    $id = $_POST['id'];
    echo json_encode(PEOPLES::get_person_profile_history($id));

    
}else if($action_perform == "get_person_record"){

    $id = $_POST['id'];
    echo json_encode(PEOPLES::get_person_record($id));

   
    
}else if($action_perform == "insertPeople"){


    $data = array(
        'id' => $_POST['id'],
        'type_person' => $_POST['type_person'],
        'document_nit' => $_POST['docNIT'],
        'identity_documents' => $_POST['docDUI'],
        'broadcast_date' => $_POST['fch_emision'],
        'expiration_date' => $_POST['fch_expiracion'],
        'place_emission' => $_POST['lgar_emision'],
        'birth_date' => $_POST['fch_nacimiento'],
        'place_birth' => $_POST['lgar_nacimiento'],
        'passport_document' => $_POST['docPasaporte'],
        'document_visa' => $_POST['docVISA'],
        'drivers_license' => $_POST['docConducir'],
        'profession' => $_POST['profesion'],
        'name' => $_POST['p_nombre'],
        'name2' => $_POST['s_nombre'],
        'surname' => $_POST['p_apellido'],
        'surname2' => $_POST['s_apellido'],
        'id_country_nationality' => $_POST['id_paisNac'],
        'nationality' => $_POST['nacionalidad'],
        'id_country_residence' => $_POST['id_paisResid'],
        'id_department' => $_POST['id_departamento'],
        'id_municipality' => $_POST['id_municipio'],
        'direction' => $_POST['direccion'],
        'email' => $_POST['email'],
        'landline' => $_POST['telFijo'],
        'cell_phone' => $_POST['telCelular'],
        'whattsapp' => $_POST['whattsapp'],
        'marital_status' => $_POST['slt_ecivil'],
        'work_place' => $_POST['lgar_trabajo'],
        'position' => $_POST['cargo'],
       
    );
        if (empty($id)) {
            echo PEOPLES::insertarPeople($data);
        }else{
            echo PEOPLES::actualizarPeople($data);
        }


/* ***********************  AREA DE PROVEEDORES ********************** */
}else if ($action_perform == "listDataVendors") {
    echo json_encode(PEOPLES::list_data_vendors()); 

}else if ($action_perform == "listDataVendorsToId") {
    $id = $_POST['id'];
    echo json_encode(PEOPLES::listDataVendorsToId($id));

} else if($action_perform == "insertVendors"){
    $data = array(
        'id' => $_POST['id'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
        'tradename' => $_POST['nombre_comercial'],
        'email' => $_POST['email'],
        'contact' => $_POST['contacto'],
        'contact_2' => $_POST['contacto_2'],
        'direction' => $_POST['direccion'],
        'term' => $_POST['plazo'],
        'description' => $_POST['descripcion'],  
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PEOPLES::insertVendors($data);
    }else{
         echo PEOPLES::updateVendors($data);
    }

}else if ($action_perform == "deleteVendors") {
    $id = $_POST['id'];
    echo json_encode(PEOPLES::deleteVendors($id));

/**************************************************************** */
}else{

}


?>