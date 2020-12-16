<?php

require_once('../../src/tcpdf/tcpdf.php');
require_once('../../db/connection.php');


$conexion=conexion();
$fechaHoy = date("d/m/y  H:i:s A");
session_start();
$id_usuario = $_SESSION['id_usuario'];




// create new PDF document
$width = "80";
$height = "99";
$pageLayout = array($width, $height); 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', $pageLayout, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('FARMACIA SAGRADA FAMILIA');
$pdf->SetTitle('FARMACIA SAGRADA FAMILIA');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
$pdf->SetHeaderData('', '', "", "", PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);



// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}


$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// ---------------------------------------------------------

// set font

$core_fonts = array('courier', 'courierB', 'courierI', 'courierBI', 'helvetica', 'helveticaB', 'helveticaI', 'helveticaBI', 'times', 'timesB', 'timesI', 'timesBI', 'symbol', 'zapfdingbats');
// add a page
$pdf->SetMargins(5, 5, 5, true);
$pdf->AddPage('L');
$pdf->SetFont('courier', '', 5);

$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-20';



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
        
    
        $tbl_head = <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       <br>
       <br>
       <br>
       <br>
EOD;






$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-21';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************


       <br>
       <br>
       <br>
       <br>
     
EOD;




$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-22';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       <br>
     
     
EOD;



















$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-23';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       <br>
       <br>
       
EOD;













$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-24';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       <br>
       
       <br>
EOD;





















$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-25';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       
       <br>
       <br>
EOD;
















$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-26';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       <br>
       <br>
       
EOD;







$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-27';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       
       <br>
       <br>
EOD;











$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-28';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
     
       <br>
       <br>
EOD;




















$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-29';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
       
       <br>
       <br>
       <br>
       <br>
EOD;










$fechaHoy = date("d/m/y  H:i:s A");
$fecha_reporte = '2020-11-30';



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
        
    
        $tbl_head .= <<<EOD
        <strong>
        <br>
        NIT:$nit NRC: $nrc 
        <br>
        $company_name
        <br>
        $company_comercial_name
        <br>
        GIRO $company_turn
        <br>
        DIRECCION: $address
        <br>
        TEL: $telephone
        </strong>
        
    EOD; 
}
    

    $tbl_head .= <<<EOD
    <br>
          Fecha de Impresion: $fechaHoy
    EOD;

	
	$detCaja = "SELECT cod, name FROM cashiers where id = '1'";
	$resCaja = mysqli_query($conexion, $detCaja);
	while ($dataCashiers = mysqli_fetch_array($resCaja)) {
		$cod_caja = strtoupper($dataCashiers['cod']);
        $name_caja = strtoupper($dataCashiers['name']);


        $tbl_head .= <<<EOD
        <br>
        CAJA: $cod_caja | $name_caja
        <br>
        EOD;
	} 
	
	
	$detCajeros = "SELECT employees.cod, users.username, CONCAT_WS(' ', system_people.name, system_people.surname) AS nombre_persona
	FROM employees
	INNER JOIN users ON employees.id_user = users.id 
	INNER JOIN system_people ON employees.id_people = system_people.id
	WHERE employees.id = 3";
	$resCajeros = mysqli_query($conexion, $detCajeros);
	
	while ($dataCashiers = mysqli_fetch_array($resCajeros)) {
		$cod_empleado = strtoupper($dataCashiers['cod']);
		$user_empleado = strtoupper($dataCashiers['username']);
        $name_empleado = strtoupper($dataCashiers['nombre_persona']);
        
        $tbl_head .= <<<EOD
        <br>
        CAJERO: $name_empleado | $user_empleado
        <br>
     EOD;   
    } 
   


   $tbl_head .= <<<EOD
   <br>
        ************************************************
<br>
       <strong> REPORTE CORTE Z - FECHA:  $fecha_reporte</strong>
<br>
        ************************************************
<br>
        ------------------------------------------------
<br>
        DETALLE DE VENTAS y DOCUMENTOS EMITIDOS
EOD;



$detalleDocumentos = "SELECT MIN(number) AS del_doc, MAX(number) AS hasta_doc FROM invoices 
WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2'  ";
$resDocumentos = mysqli_query($conexion, $detalleDocumentos);

while ($dataCierre = mysqli_fetch_array($resDocumentos)) {
    $desde = strtoupper($dataCierre['del_doc']);
    $hasta = strtoupper($dataCierre['hasta_doc']);
    $tbl_head .= <<<EOD

    <br>
        DOCUMENTO: TICKET DE VENTA
    <br>
        Del : $desde AL $hasta
    <br>
    EOD;
} 


$detalleVentas = "SELECT total_document FROM invoices WHERE invoices.date = '$fecha_reporte' && invoices.id_document = '2' ";
$resVentas = mysqli_query($conexion, $detalleVentas);

$total_venta_dia = "";
while ($dataVenta = mysqli_fetch_array($resVentas)) {
    $total_vta = $dataVenta['total_document'];
    $total_venta_dia = $total_venta_dia + floatval($total_vta);
} 

$tbl_head .= <<<EOD
        Ventas Totales $total_venta_dia
<br>
       ------------------------------------------------
       <br>
       ************************************************
    
EOD;





                    
$pdf->writeHTML($tbl_head, true, false, false, false, '');

   

$pdf->Output('reporteInventarios.pdf', 'I', 'L');
