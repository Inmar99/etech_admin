<?php 

session_start();
require  ("../model/admin_model.php"); 

/* Get var by POST to execute an action  */
$action_perform = $_POST['action'];

/* ***********************  AREA DE ADMIN ********************** */
if ($action_perform == "getCompanyInfo") {
    echo json_encode(ADMIN::obtenerDatosEmpresa());  

}else if ($action_perform == "listDataMovements") {
    echo json_encode(ADMIN::listDataMovements());  

}else if ($action_perform == "list_movementsTypes") {
    echo json_encode(ADMIN::list_movementsTypes());

}else if ($action_perform == "valid_management") {
    echo json_encode(ADMIN::valid_management());
}else if ($action_perform == "getCompanyInfoProfile") {
    $profile_data = ADMIN::obtenerDatosEmpresaProfile();
    if (is_array($profile_data)) {

        $_SESSION['company_name'] = $profile_data['company_name'];
        $_SESSION['company_comercial_name'] = $profile_data['company_comercial_name'];
        $_SESSION['prefix'] = $profile_data['prefix'];
    }

} else if ($action_perform == "updateCompany"){
    $datos = array(
        'id' => $_POST['id'], 
        'company_name' => $_POST['cmpName'],
        'company_comercial_name' => $_POST['cmpLegalName'], 
        'company_turn' => $_POST['cmpTurn'], 
        'company_slogan' => $_POST['cmpSlogan'], 
        'legal_representative' => $_POST['cmpLegalRep'], 
        'postal_code' => $_POST['cmpPostalCode'], 
        'address' => $_POST['cmpAddress'],
        'country' => $_POST['cmpCountry'], 
        'state' => $_POST['cmpState'], 
        'municipality' => $_POST['cmpMunicipality'], 
        'city' => $_POST['cmpCity'],
        'telephone' => $_POST['cmpTelephone'], 
        'fax'  => $_POST['cmpFAX'],
        'email' => $_POST['cmpEmail'], 
        'nit' => $_POST['cmpNIT'],
        'nrc' => $_POST['cmpNRC']
    );

    $id = $_POST['id'];
    if (empty($id)) {
        
    }else{
        echo ADMIN::updateCompany($datos);
    }
}else if($action_perform == "insertMovements"){
    $data = array(
        'id_employe' => $_SESSION['id_usuario'], 
        'codigo' => $_POST['codigo'],
        'afecta' => $_POST['afecta'],
        'type_movement' => $_POST['type_movement'],
        'monto' => $_POST['monto'],
        'description' => $_POST['descripcion'],  
    );

        echo ADMIN::inserMovements($data);

        
}else if($action_perform == "createManagement"){
    $data = array(
        'type' => $_POST['type'],
        'mount' => $_POST['mount'],
        'id_employe' => $_SESSION['id_usuario'], 
        'id_user' => $_SESSION['id_usuario'], 
    );

        echo ADMIN::createManagement($data);

}else if($action_perform == "validDayInit"){
        echo json_encode(ADMIN::validDayInit());
}else if($action_perform == "validDayFinish"){
    echo json_encode(ADMIN::validDayFinish());
}






?>