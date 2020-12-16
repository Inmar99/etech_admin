<?php

session_start();
require("../model/model_user.php");

/* Get var by POST to execute an action  */
$action_perform = $_POST['action'];


if ($action_perform == "validate_login") {
    $data = array(
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    );
    $user_data = USER::validate_login($data);

    if (is_array($user_data)) {
        if ($user_data['state'] == 1) {

            if ($user_data['levels'] >= 10) {
                $id_usuario = $user_data['id'];
                $_SESSION['id_usuario'] =  $id_usuario;
                $_SESSION['email_usuario'] = $user_data['email'];
                $_SESSION['estado_usuario'] = $user_data['state'];
                $_SESSION['nivel_usuario'] = $user_data['levels'];

                $profile_data = USER::getProfile($id_usuario);
                if (is_array($profile_data)) {

                    $id_perfil = $profile_data['id'];
                    $_SESSION['id_perfil'] = $id_perfil;
                    $_SESSION['nombre_perfil'] = $profile_data['name'];
                    $_SESSION['apellido_perfil'] = $profile_data['surname'];
                    $_SESSION['alias_perfil'] = $profile_data['alias'];
                    $_SESSION['imagen_perfil'] = $profile_data['imagen'];
                    $_SESSION['direcion_perfil'] =  $profile_data['direction'];
                    $_SESSION['ciudad_perfil'] = $profile_data['nationality'];
                    $_SESSION['acerca_perfil'] = $profile_data['about'];
                    $_SESSION['cargo_perfil'] = $profile_data['position'];
                    $_SESSION['contacto_perfil'] = $profile_data['contact'];

                    $nombre_perfil =  $profile_data['name'] . " " .$profile_data['surname']; 

                    echo json_encode(array('error' => false, 'name' => $nombre_perfil));
                } else {
                    echo json_encode(array('error' => true, 'msg' => "Al parecer no existe un perfil para este usuario"));
                }
            } else {
                echo json_encode(array('error' => true, 'msg' => "Al parecer no tiene permiso para acceder a este recurso"));
            }
        } else if ($user_data['state'] == 2) {
            echo json_encode(array('error' => true, 'msg' => "Este usuario actualmente no se encuentra activo"));
        } else {
            echo json_encode(array('error' => true, 'msg' => "Este usuario actualmente se encuentra bloqueado"));
        }
    } else {
        echo json_encode(array('error' => true, 'msg' => "El usuario o contraseña no coincide"));
    }
} else if ($action_perform == "insert_perfil") {
    $data = array(
        'id' => $_POST[''],
        'name' => $_POST[''],
        'surname' => $_POST[''],
        'alias' => $_POST[''],
        'img' => $_POST[''],
        'direction' => $_POST[''],
        'city' => $_POST[''],
        'about' => $_POST[''],
        'contact' => $_POST[''],
    );

    $id =  $_POST['id_perfil'];
    if (empty($id)) {
        echo USER::insertarPerfil($data);
    } else {
        echo USER::actualizarPerfil($data);
    }
} else if ($action_perform == "verificar_credencial") {
    $data = array(
        'passw' => $_POST['passw'],
        'id_user' => $_SESSION['id_usuario'],
    );

    $data_password = USER::obtenerPassword($data);

    if (!empty($data_password['email'])) {
        echo json_encode(array('error' => false));
    } else {
        echo json_encode(array('error' => true, 'msg' => "Al parecer su actual contraseña no coincide en nuestra base de data"));
    }
} else if ($action_perform == "listUsers") {
    echo json_encode(USER::list_data());
} else if ($action_perform == "getLevelUsers") {
    echo json_encode(USER::getLevelUsers());
} else if ($action_perform == "getUsers") {
    echo json_encode(USER::list_users());
} else if ($action_perform == "verifyUsername") {
    $username = $_POST['value'];
    echo json_encode(USER::user_exist($username));
} else if ($action_perform == "getUserStatuses") {
    echo json_encode(USER::get_user_statuses());
} else if ($action_perform == "createUser") {

    if ($_POST['usrPass'] != $_POST['usrConfPass']) {
        return false;
    }

    $data = array(
        'id' => $_POST['id'],
        'email' => $_POST['usrEmail'],
        'username' => $_POST['usrName'],
        'password' => $_POST['usrPass'],
        'status' => $_POST['usrStatus'],
        'level' => $_POST['usrLevel'],
    );

    $id =  $_POST['id'];
    if (empty($id)) {
        echo json_encode(USER::insertarUser($data));
    } else {
        echo json_encode(USER::actualizarUser($data));
    }
} else if ($action_perform == "getUser") {
    $id = $_POST['id'];

    if (!empty($id)) {
        echo json_encode(USER::getUserById($id));
    }    
}

?>