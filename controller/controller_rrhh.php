<?php

session_start();
require "../model/rrhh_model.php";

/* Get var by POST to execute an action  */
$action_perform = $_POST['action'];

if ($action_perform == "searchPeople") {
    $identity_documents = $_POST['identity_documents'];
    echo json_encode(RRHH::searchPeople($identity_documents));

}else if ($action_perform == "validateExistEmployee") {
    $id = $_POST['id'];
    echo json_encode(RRHH::validateExistEmployee($id));
} else if ($action_perform == "list_data_employees") {
    echo json_encode(RRHH::list_data_employees());
    
} else if ($action_perform == "createEmployee") {
   
    $id = $_POST['id'];
    if (empty($id)) {
        $data = array(
            'id' => $_POST['id'],
            'id_people' => $_POST['id_people'],
            'codigo' => $_POST['codigo'],
            'correo' => $_POST['correo'],
            'departament' => $_POST['departament'],
            'cargo' => $_POST['cargo'],
            'alias' => $_POST['alias'],
            'user' => $_POST['user'],
            'password' => $_POST['password'],
            'estate' => $_POST['estate'],
            'level' => $_POST['level'],
        );
    
        echo RRHH::createEmployee($data);
    } else {

        $data_a = array(
            'id' => $_POST['id_edit'],
            'codigo' => $_POST['codigo_edit'],
            'departament' => $_POST['departament_edit'],
            'cargo' => $_POST['cargo_edit'],
        );
    
        echo RRHH::updateEmployee($data_a);
    }
}else if ($action_perform == "searchEmployee") {
    $id = $_POST['identity_documents'];
    echo json_encode(RRHH::searchEmployee($id));

} else if ($action_perform == "createCodEmployee") {
    echo json_encode(RRHH::createCodEmployee());

} else if ($action_perform == 'list_departaments') {
    echo json_encode(RRHH::list_data_departaments());

} else if ($action_perform == "listDataDepartament") {
    echo json_encode(RRHH::list_data_departaments());

} else if ($action_perform == "listDataDepartamentToId") {
    $id = $_POST['id'];
    echo json_encode(RRHH::listDataDepartamentsToId($id));

} else if ($action_perform == "insertDepartament") {
    $data = array(
        'id' => $_POST['id'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
        'description' => $_POST['descripcion'],
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo RRHH::insertDepartament($data);
    } else {
        echo RRHH::updateDepartament($data);
    }

} else if ($action_perform == "deleteDepartament") {
    $id = $_POST['id'];
    echo json_encode(RRHH::deleteDepartament($id));

}else if ($action_perform == "getEmployeeMarkerCod") {
    $cod = $_POST['cod'];
    echo json_encode(RRHH::getEmployeeMarkerCod($cod));
}else if ($action_perform == "generateMarkerEmployee") {
    $id = $_POST['id'];
    $type = $_POST['type'];

    $data = array(
        'id' => $id,
        'type' => $type
    );

    echo json_encode(RRHH::generateMarkerEmployee($data));
}else if ($action_perform == "searchMarkerEmployee") {
    setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/El_Salvador');
$fecha = date("Y-m-d");

    $id = $_POST['id'];

    $data = array(
        'id_employee' => $_POST['id'],
        'date' => $fecha
    );
    echo json_encode(RRHH::searchMarkerEmployee($data));
}else if ($action_perform == "searchMaxEmployee") {
    echo json_encode(RRHH::searchMaxEmployee());
   
}else if ($action_perform == "getDataEmployee") {
    $id = $_POST['id'];
    echo json_encode(RRHH::getDataEmployee($id));
}else {

}
