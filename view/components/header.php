<?php 

/**
*
* Inmar Cortez | Programer & CEO (iPOS-Systems)
* Copyright  iPOS-Systems
* Coded by inmarcortez | inmarcortez@outlook.com
* Creado el: 10-05-2020
*
**/

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?php 
  
  if (isset($title)) {
    
  }else{
    $title = "Home";
  }
  
  echo $title ?></title>
  <!-- Favicon -->
  <link rel="icon" href="<?php echo $src; ?>img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?php echo $src; ?>fonts/google/Open+Sans.css">
  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo $src; ?>vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="<?php echo $src; ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="<?php echo $src; ?>datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $src; ?>datatables/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $src; ?>datatables/select.bootstrap4.min.css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?php echo $src; ?>css/argon.css?v=1.2.0" type="text/css">

  <link  rel="stylesheet" href="<?php echo $src; ?>Select/css/select2.css" type="text/css"/>

 
</head>
