<?php 
/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 12-05-2020
*
**/


session_start();


$src = "../../src/";
$view = "../../view/";
$controller = "../../components/";



/* VARIABLES DE SESION GENERALES */


if (empty($_SESSION['estado_usuario'])) {
    $_SESSION['estado_usuario'] = "--";
}

if (empty($_SESSION['nombre_perfil'])) {
    $_SESSION['nombre_perfil'] = "--";
}
if (empty($_SESSION['apellido_perfil'])) {
    $_SESSION['apellido_perfil'] = "-";
}
if (empty($_SESSION['imagen_perfil'])) {
    $_SESSION['imagen_perfil'] = "img/perfil/perfil_general.png";
}
if (empty($_SESSION['direcion_perfil'])) {
    $_SESSION['direcion_perfil'] = "-";
}
if (empty($_SESSION['ciudad_perfil'])) {
    $_SESSION['ciudad_perfil'] = "-";
}
if (empty($_SESSION['acerca_perfil'])) {
    $_SESSION['acerca_perfil'] = "-";
}
if (empty($_SESSION['cargo_perfil'])) {
    $_SESSION['cargo_perfil'] = "-";
}
if (empty($_SESSION['contacto_perfil'])) {
    $_SESSION['contacto_perfil'] = "-";
}





?>