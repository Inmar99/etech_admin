<?php

require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


/* AGREGANDO LA CONEXION A LA BASE DE DATOS */
require_once('../../../db/connection.php');

$conexion=conexion();



function imprmirTicket($conexion,$impresor){
	$connector = new WindowsPrintConnector($impresor);
	$printer = new Printer($connector);

	$printer->pulse(); 
	$printer->close();
}


/* Obteniendo data del impresor predeterminado */
$sql_printer = "SELECT name FROM system_printers";
$res_printer = mysqli_query($conexion, $sql_printer);
$res = (mysqli_fetch_array($res_printer));
$impresor = $res['name'];
	
if ($impresor == "" || $impresor == ' ' || $impresor == 'null') {
	$impresor = 'printerIPOS';
}else{
	/* No deberia asignarse otro valor debido a que ya lo mantiene */
}


imprmirTicket($conexion, $impresor);

	


    


?>