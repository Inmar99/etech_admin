<?php

require __DIR__ . '/ticket/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


/* AGREGANDO LA CONEXION A LA BASE DE DATOS */
require_once('../../../db/connection.php');

$conexion=conexion();



function imprmirTicket($conexion, $id_orden, $impresor){
	$connector = new WindowsPrintConnector($impresor);
	$printer = new Printer($connector);

	setlocale(LC_ALL, 'es_ES');
	date_default_timezone_set('America/El_Salvador');
	$fechaHoy = date("d/m/y  H:i:s A");
	
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setFont(Printer::FONT_A);
		
	try{
		$logo = EscposImage::load("Logo.png", false);
		$printer->bitImage($logo);
	}catch(Exception $e){
	
	} 



	
	
	
	$sql_invoice = "SELECT  id_document,number, total_document AS total, total_document_desc AS descuento, desc_recipe as descuento_receta,desc_invoice_plus as descuento_plus, mount AS paga_con, cash AS cambio FROM invoices WHERE id = $id_orden";
	$res_invoice = mysqli_query($conexion, $sql_invoice);
	while ($dataInvoice = mysqli_fetch_array($res_invoice)) {
		$numero_venta = strtoupper($dataInvoice['number']);
		$id_documento = strtoupper($dataInvoice['id_document']);
		$total = strtoupper($dataInvoice['total']);
		$descuento = strtoupper($dataInvoice['descuento']);
		$descuento_receta = strtoupper($dataInvoice['descuento_receta']);
		$descuento_plus = strtoupper($dataInvoice['descuento_plus']);
		$paga_con = strtoupper($dataInvoice['paga_con']);
		$cambio = strtoupper($dataInvoice['cambio']);
	} 
	
	
	$printer->feed(1);
	
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
	$printer->text($fechaHoy . "\n");
	
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
	INNER JOIN invoices ON employees.id = invoices.id_seller
	WHERE invoices.id = $id_orden";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
		$name_empleado = strtoupper($dataCashiers['nombre_persona']);
		$printer->text("CAJERO: $name_empleado | $user_empleado" . "\n");
	} 
	
	$detCliente = "SELECT 
		invoices.id_client, invoices.id_seller, invoices.id_document, invoices.id_casher, invoices.final_date,
		sys_tipeof_pay.cod AS codigo_pago,
		sys_tipeof_pay.name AS tipo_pago,
		system_people.name AS cliente
		FROM invoices
		INNER JOIN sys_tipeof_pay ON invoices.id_typeofpay = sys_tipeof_pay.id
		INNER JOIN system_clients ON invoices.id_client = system_clients.id
		INNER JOIN system_people ON system_clients.id_people = system_people.id
		WHERE invoices.id  = $id_orden";
	$resClientes = mysqli_query($conexion, $detCliente);
	
	while ($dataClientes = mysqli_fetch_array($resClientes)) {
		$codigo_pago = strtoupper($dataClientes['codigo_pago']);
		$tipo_pago = strtoupper($dataClientes['tipo_pago']);
		$cliente = strtoupper($dataClientes['cliente']);
		$printer->text("CLIENTE: $cliente " . "\n");
		$printer->text("FORMA DE PAGO: $codigo_pago - $tipo_pago" . "\n");
	} 
	
	$printer->feed(1);
	
	$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------" . "\n");
$printer->text("DESCRIPCION           CANT. PRES. PRECIO. TOTAL\n");
$printer->text("------------------------------------------------"."\n");



$detalleVenta = "SELECT id_product, name, presentation, cant, sale_price, sale_price_suggested FROM invoice_details WHERE id_invoice = '$id_orden'";
$resVenta = mysqli_query($conexion, $detalleVenta);


$cant_products = 0;
$total_descuento = 0;
$total_final = 0;

while ($dataVenta = mysqli_fetch_array($resVenta)) {
    $id_product = strtoupper($dataVenta['id_product']);
    $name = strtoupper($dataVenta['name']);
    $presentation = strtoupper($dataVenta['presentation']);
    $cant = strtoupper($dataVenta['cant']);
    $sale_price = strtoupper($dataVenta['sale_price']);
    $sale_price_suggested = strtoupper($dataVenta['sale_price_suggested']);
        
    $cant_products = $cant_products + $cant;
    $total_product = $cant * $sale_price;
   /*  $descuento = $sale_price_suggested - $sale_price; */

    
	$total_final = $total_final + $total_product;
	$sub_total = $total_final + $total_descuento;


   
    $printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text("$name\n");
	$printer->setJustification(Printer::JUSTIFY_RIGHT);
	$printer->text("$cant   $presentation   $$sale_price  $$total_product  \n");
} 



$printer->setJustification(Printer::JUSTIFY_LEFT); 
$printer->text("------------------------------------------------" . "\n");
$printer->setJustification(Printer::JUSTIFY_RIGHT);
$printer->text(" SUBTOTAL: $$sub_total\n");
$printer->text("DESCUENTO: $$descuento\n");
$printer->text("      IVA: $00.00\n");
if ($descuento_receta > 0) {
	$printer->text("DESCUENTO POR RECETA MEDICA: $$descuento_receta\n");
	$total_final = $total_final - $descuento_receta;
}else{

}
		
if ($descuento_plus > 0) {
$printer->text("DESCUENTO POR COMPRAS MAYORES: $$descuento_plus\n");
$total_final = $total_final - $descuento_plus;
}else{
	
}
$printer->text("    TOTAL: $$total_final\n");
$printer->text(" EFECTIVO: $$paga_con\n");
$printer->text("   CAMBIO: $$cambio\n");
$printer->feed(1);

$printer->setJustification(Printer::JUSTIFY_LEFT);


require_once("Funciones.php");
$letras = new  EnLetras();
$total_letras = strtoupper($letras->ValorEnLetras($total_final,"DOLARES","CENTAVOS"));
$printer->text("SON: $total_letras\n");
$printer->text("TOTAL DE ARTICULOS: $cant_products\n");
$printer->feed(2);


$printer->setJustification(Printer::JUSTIFY_CENTER); 
$printer -> setTextSize(2, 1);
$printer->text("TICKET :" . $numero_venta . "\n");
$printer->feed(1);
$printer->setBarcodeHeight(90);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer->barcode($numero_venta);

$printer->feed(2);
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer -> setTextSize(1, 1);

$detResoluciones = "SELECT authorization, resolution, of_the, to_the FROM systems_documents_details WHERE id_document = '2'";
$resResoluciones = mysqli_query($conexion, $detResoluciones);

while ($dataResoluciones = mysqli_fetch_array($resResoluciones)) {
	$authorization = strtoupper($dataResoluciones['authorization']);
	$resolution = strtoupper($dataResoluciones['resolution']);
	$of_the = strtoupper($dataResoluciones['of_the']);
	$to_the = strtoupper($dataResoluciones['to_the']);

	$printer->text("AUTORIZACION # $authorization" . "\n");
	$printer->text("RESOLUCION # $resolution" . "\n");
	$printer->text("DE  $of_the" . "\n");
	$printer->text("AL  $to_the" . "\n");

} 
	
	
	$printer->feed(1);
	
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("NO SE ACEPTAN DEVOLUCIONES DESPUES\n");
	$printer->text("DE 15 DIAS A PARTIR DE SU COMPRA\n");
	$printer->text("SI EL PRODUCTO HA SIDO ABIERTO O\n");
	$printer->text("UTILIZADO  PARCIALMENTE O SI \n");
	$printer->text("PRESENTA DAÑOS FISICOS DE SU EMPAQUE \n");
	$printer->text("Y SI NO SE PRESENTA ESTE DOCUMENTO \n");
	$printer->text("NO APLICA DEVOLUCIONES.\n");
	$printer->text("NO APLICA PARA MEDICAMENTOS REFRIGERADOS \n");
	$printer->feed(1);
	$printer->text("*GRACIAS POR SU COMPRA*\n");
	
	
	$printer->feed(3);
	$printer->cut();

	$printer->close();



}



/* VALIDANDO VARIABLES */

if (isset($_POST['id_invoice'])) {
	$id_orden = $_POST['id_invoice'];
} else {
	#Si no existe en el get un numero de venta entonces consultamos la ultima venta del dia
	$sql_ventaF = "SELECT MAX(id) as id FROM invoices";
	$res_ventaF = mysqli_query($conexion, $sql_ventaF);
	$res = (mysqli_fetch_array($res_ventaF));
	$id_orden = $res['id'];
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


imprmirTicket($conexion, $id_orden, $impresor);

	


    


?>