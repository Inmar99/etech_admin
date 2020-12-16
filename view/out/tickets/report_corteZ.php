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


/* APERTURA - SOLO EL MONTO DE APERTURA */

$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer->text("DETALLE DE APERTURA\n");

setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/El_Salvador');
$fecha_reporte = date("Y-m-d");
$detalleApertura = "SELECT cachiers_management.id, cachiers_management.mount, cachiers_management.date_hour, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
FROM cachiers_management 
INNER JOIN users ON cachiers_management.id_user = users.id
INNER JOIN system_people ON cachiers_management.id_user = system_people.id
WHERE cachiers_management.`type` = 'APERTURA' && cachiers_management.date = '$fecha_reporte'";
$resApertura = mysqli_query($conexion, $detalleApertura);

while ($dataApertura = mysqli_fetch_array($resApertura)) {
    $monto_apertura = strtoupper($dataApertura['mount']);
    $fecha_hora_apertura = strtoupper($dataApertura['date_hour']);
    $usuario = strtoupper($dataApertura['nombre_persona']);

   
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Fecha: $fecha_hora_apertura\n");
    $printer->text("Usuario: $usuario\n");
    $printer->text("Monto: $monto_apertura\n");
    $letras = new  EnLetras();
    $total_letras = strtoupper($letras->ValorEnLetras($monto_apertura,"DOLARES","CENTAVOS"));
    $printer->text("$total_letras\n");
} 
$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------"."\n");




/* MOVIMENTOS - TOTALES DE ENTRAN Y SALEN */



$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer->text("DETALLE DE MOVIMIENTOS DE CAJA\n");


$printer->setJustification(Printer::JUSTIFY_LEFT); 

$detalleCierre = "SELECT mount FROM cachiers_movements  
WHERE TYPE = 'ENTRA' && cachiers_movements.date = '$fecha_reporte'";
$resCierre = mysqli_query($conexion, $detalleCierre);

$total_entra = 0;
while ($dataCierre = mysqli_fetch_array($resCierre)) {
    $total_movEntra = $dataCierre['mount'];
    $total_entra = $total_entra + floatval($total_movEntra);
}

$printer->text("TOTAL EFECTIVO ENTRA: $total_entra\n");
$letras = new  EnLetras();
$total_letras = strtoupper($letras->ValorEnLetras($total_entra,"DOLARES","CENTAVOS"));
$printer->text("$total_letras\n");

$detalleCierre = "SELECT mount FROM cachiers_movements  
WHERE TYPE = 'SALE' && cachiers_movements.date = '$fecha_reporte'";
$resCierre = mysqli_query($conexion, $detalleCierre);

$total_salen = 0;
while ($dataCierre = mysqli_fetch_array($resCierre)) {
    $total_movSale = $dataCierre['mount'];
    $total_salen = $total_salen + floatval($total_movSale);
}

$printer->text("TOTAL EFECTIVO SALE: $total_salen\n");
$letras = new  EnLetras();
$total_letras = strtoupper($letras->ValorEnLetras($total_salen,"DOLARES","CENTAVOS"));
$printer->text("$total_letras\n");

$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------"."\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
/* FINALIZA EL DETALLE DE CIERRE */





$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer->text("DETALLE DE VENTAS\n");



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices
WHERE invoices.date = '$fecha_reporte' ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Documentos Emitidos\n");
    $printer->text("Del : $desde AL $hasta\n");
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' ";
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
$printer->text("------------------------------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer->text("DETALLE DE CIERRE\n");
$detalleCierre = "SELECT cachiers_management.id, cachiers_management.mount, cachiers_management.date_hour, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
FROM cachiers_management 
INNER JOIN users ON cachiers_management.id_user = users.id
INNER JOIN system_people ON cachiers_management.id_user = system_people.id
WHERE cachiers_management.`type` = 'CIERRE' && cachiers_management.date = '$fecha_reporte'";
$resCierre = mysqli_query($conexion, $detalleCierre);

while ($dataCierre = mysqli_fetch_array($resCierre)) {
    $monto_cierre = strtoupper($dataCierre['mount']);
    $fecha_hora_apertura = strtoupper($dataCierre['date_hour']);
    $usuario = strtoupper($dataCierre['nombre_persona']);
   
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Fecha: $fecha_hora_apertura\n");
    $printer->text("Usuario: $usuario\n");
    $printer->text("Monto: $monto_cierre\n");
    $letras = new  EnLetras();
    $total_letras = strtoupper($letras->ValorEnLetras($monto_cierre,"DOLARES","CENTAVOS"));
    $printer->text("$total_letras\n");
} 
$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------"."\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
/* FINALIZA EL DETALLE DE CIERRE */




$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("************************************************"."\n");
$total_caja = 0;
$total_caja = $monto_apertura + $total_entra + $total_venta_dia - $total_salen;
$total_diferencia = $monto_cierre - $total_caja;
$printer->text("TOTAL EFECTIVO CAJA: $total_caja\n");
$letras = new  EnLetras();
$total_letras = strtoupper($letras->ValorEnLetras($total_caja,"DOLARES","CENTAVOS"));
$printer->text("$total_letras\n");

$printer->text("DIFERENCIA: $total_diferencia\n");
$letras = new  EnLetras();
$total_letras = strtoupper($letras->ValorEnLetras($total_diferencia,"DOLARES","CENTAVOS"));

$printer->text("$total_letras\n");
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