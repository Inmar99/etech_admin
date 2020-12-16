<?php

require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


/* AGREGANDO LA CONEXION A LA BASE DE DATOS */
require_once('../../../db/connection.php');

$conexion=conexion();



function imprmirTicket($conexion, $impresor){
    session_start();
    require_once("Funciones.php");
    $id_usuario = $_SESSION['id_usuario'];

	$connector = new WindowsPrintConnector($impresor);
	$printer = new Printer($connector);

	setlocale(LC_ALL, 'es_ES');
	date_default_timezone_set('America/El_Salvador');
    $fechaHoy = date("d/m/y  H:i:s A");
    $fecha_reporte = date("Y-m-d");
	
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setFont(Printer::FONT_A);
		

	/* Buscando el encabezado de la empresa */
	$encabezado = "SELECT * FROM company_profile";
	$resEncabezado = mysqli_query($conexion, $encabezado);
	
	/* ENCABEZADO DE LOS RUBROS */
	while ($dataEncabezado = mysqli_fetch_array($resEncabezado)) {
	
		$company_name = strtoupper($dataEncabezado['company_name']);
		$company_comercial_name = strtoupper($dataEncabezado['company_comercial_name']);
		$company_turn = strtoupper($dataEncabezado['company_turn']);
		$address = strtoupper($dataEncabezado['address']);
		$nit = strtoupper($dataEncabezado['nit']);
		$nrc = strtoupper($dataEncabezado['nrc']);
		$telephone = strtoupper($dataEncabezado['telephone']);
	
		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->text("NIT:$nit NRC: $nrc" . "\n");
		$printer->text("$company_name" . "\n");
		$printer->text("$company_comercial_name" . "\n");
		$printer->text("GIRO"."\n");
		$printer->text("$company_turn". "\n");
		$printer->text("DIRECCION: $address" . "\n");
		$printer->text("TEL: $telephone" . "\n");
	}
	
	$printer->feed(1);
	$printer->text("Fecha de impresion:".$fechaHoy . "\n");
	
	$detCaja = "SELECT cod, name FROM cashiers";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
		$name_caja = strtoupper($dataCashiers['name']);
		$printer->text("CAJA: $cod_caja | $name_caja" . "\n");
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = $id_usuario";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
		$name_empleado = strtoupper($dataCashiers['nombre_persona']);
		$printer->text("CAJERO: $name_empleado | $user_empleado" . "\n");
	} 
	$printer->feed(1);
$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("************************************************"."\n");
$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer->text("REPORTE CORTE Z $fecha_reporte"."\n");
$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("************************************************"."\n");

$printer->feed(1);

$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer->text("DETALLE DE VENTAS\n");



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Documentos Emitidos\n");
    $printer->text("TICKET DE VENTA\n");
    $printer->text("Del : $desde AL $hasta\n");
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Ventas Totales $total_venta_dia\n");
$letras = new  EnLetras();
$total_letras = strtoupper($letras->ValorEnLetras($total_venta_dia,"DOLARES","CENTAVOS"));
$printer->text("$total_letras\n");

$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------"."\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
/* FINALIZA EL DETALLE DE VENTAS */



/* CIERRE - SOLO EL MONTO DE CIERRE */

$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("************************************************"."\n");
$printer->text("************************************************"."\n");

	$printer->feed(1);
	$printer->feed(3);
	$printer->cut();
	$printer->close();




	
}




/* VALIDANDO VARIABLES */

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