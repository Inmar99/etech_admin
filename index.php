<?php 

/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 10-05-2020
*
**/

if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_perfil'])) {
    header("Location: view/pages/home.php");
}else{
    header("Location: view/pages/login.php");
}

?>