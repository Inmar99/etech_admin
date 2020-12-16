<?php
/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 10-05-2020
*
**/
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
?>

