<?php

require_once('../../src/tcpdf/tcpdf.php');
require_once('../../db/connection.php');


$conexion=conexion();
$fechaHoy = date("d/m/y  H:i:s A");




// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('FARMACIA SAGRADA FAMILIA');
$pdf->SetTitle('FARMACIA SAGRADA FAMILIA');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



$title = "FARMACIA SAGRADA FAMILIA - NUEVA GUADALUPE, SAN MIGUEL, EL SALVADOR";
$sub_title = "REPORTE DE INVENTARIOS | $fechaHoy ";
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, $sub_title, PDF_HEADER_STRING);

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

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font

$core_fonts = array('courier', 'courierB', 'courierI', 'courierBI', 'helvetica', 'helveticaB', 'helveticaI', 'helveticaBI', 'times', 'timesB', 'timesI', 'timesBI', 'symbol', 'zapfdingbats');
// add a page
$pdf->SetMargins(10, 20, 10, true);
$pdf->AddPage('L');






$pdf->SetFont('timesB', 'B', 15);
/* Texto que representa el Rubro, Grupo y Sub-grupo */

$rubProducts = "SELECT id,cod, name FROM products_rub";
$resReb = mysqli_query($conexion, $rubProducts);



/* ENCABEZADO DE LOS RUBROS */
while ($dataRub = mysqli_fetch_array($resReb)) {

    $id_rub = strtoupper($dataRub['id']);
    $cod_rub = strtoupper($dataRub['cod']);
    $name_rub = strtoupper($dataRub['name']);


    $pdf->SetFont('timesB', 'B', 15);
    $encabezado = <<<EOD
    <h2>$cod_rub - $name_rub</h2>
    EOD;

    $groupProducts = "SELECT id,cod, name FROM products_group WHERE id_rub = $id_rub";
    $resGroup = mysqli_query($conexion, $groupProducts);

    $pdf->writeHTML($encabezado, true, false, false, false, '');

    while ($dataGroup = mysqli_fetch_array($resGroup)) {
        $id_group = strtoupper($dataGroup['id']);
        $cod_group = strtoupper($dataGroup['cod']);
        $name_group = strtoupper($dataGroup['name']);
        
        $pdf->SetFont('courierB', '', 12);
        $encabezado_grupo = <<<EOD
        <h4>$cod_group - $name_group</h4>
        EOD;



        $subgroupProducts = "SELECT id,cod, name FROM products_subgroup WHERE id_group = $id_group";
        $resSubGroup = mysqli_query($conexion, $subgroupProducts);

        $pdf->writeHTML($encabezado_grupo, true, false, false, false, '');
    
        while ($dataSubGroup = mysqli_fetch_array($resSubGroup)) {
            $id_subgroup = strtoupper($dataSubGroup['id']);
            $cod_subgroup = strtoupper($dataSubGroup['cod']);
            $name_subgroup = strtoupper($dataSubGroup['name']);
            
            $pdf->SetFont('courierI', '', 10);
            $encabezado_subgrupo = <<<EOD
            <h4>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cod_subgroup - $name_subgroup</h4>
            EOD;
    
            $pdf->writeHTML($encabezado_subgrupo, true, false, false, false, '');

           
            $products = "SELECT products.id, products.cod, products.bar_code, products.name, products.sale_price, 
            products.sale_price_1, products.cost, products.description,
            products_laboratories.name AS laboratorie, 
            vendors.name AS Proveedor ,
            products_locations.name AS location
             FROM products
            INNER JOIN products_laboratories ON products.id_laboratorie = products_laboratories.id
            INNER JOIN products_locations ON products.id_location = products_locations.id
            INNER JOIN vendors ON products.id_vendor = vendors.id
            WHERE products.id_subgroup = $id_subgroup";
            $resProduct = mysqli_query($conexion, $products);

            $pdf->SetFont('courierB', '', 12);
             /* Encabezado de la tabla - este es estatico */
             $tbl_head = <<<EOD
             <table cellspacing="0" cellpadding="2" border="0.5">
                 <tr>
                     <th width="60">Cod.</th>
                     <th width="90">Cod. Barra</th>
                     <th width="350">Nombre</th>
                     <th width="140">Laboratorio</th>
                     <th width="60">Precio Sugerido</th>
                     <th width="60">Precio Venta</th>
                     <th width="160">Ubicacion</th>
                     <th width="60">#</th>
                 </tr>
             EOD;
    
                while ($dataProd = mysqli_fetch_array($resProduct)) {
                    $id_prod = strtoupper($dataProd['id']);
                    $cod_prod = strtoupper($dataProd['cod']);
                    $barcode_prod = strtoupper($dataProd['bar_code']);
                    $name_prod = strtoupper($dataProd['name']);
                    $price_prod = strtoupper($dataProd['sale_price']);
                    $price1_prod = strtoupper($dataProd['sale_price_1']);
                    $description_prod = strtoupper($dataProd['description']);
                    $proveedor_prod = strtoupper($dataProd['Proveedor']);
                    $laboratorie_prod = strtoupper($dataProd['laboratorie']);
                    $location_prod = strtoupper($dataProd['location']);


                    $pdf->SetFont('times', '', 9);
                    $tbl_head .= <<<EOD
                        <tr>
                            <td width="60">$cod_prod</td>
                            <td width="90">$barcode_prod</td>
                            <td width="350">$name_prod</td>
                            <td width="140">$laboratorie_prod</td>
                            <td width="60">$price_prod</td>
                            <td width="60">$price1_prod</td>
                            <td width="160">$location_prod</td>
                            <td width="60"></td>
                        </tr>
                    EOD; 



                    
                  /*   $pdf->writeHTML($encabezado_subgrupo, true, false, false, false, ''); */

                
                    $productsPresentations = "SELECT NAME as name, factor, sale_price FROM products_presentations WHERE id_product  = $id_prod";
                    $resProductPresentations = mysqli_query($conexion, $productsPresentations);
                    $row_cnt = $resProductPresentations->num_rows;

                    if($row_cnt >0){
                        $pdf->SetFont('times', 'B', 10);
                        $tbl_head .= <<<EOD
                            <tr>
                                <td width="60"></td>
                                <td width="90"></td>
                                <th width="350"></th>
                                <th width="140"><strong>Presentacion.</strong></th>
                                <th width="60"><strong>Factor</strong></th>
                                <td width="60"><strong>Precio</strong></td>
                                <td width="160"></td>
                                <td width="60"></td>
                            </tr>
                        EOD;
                        while ($dataProdPres = mysqli_fetch_array($resProductPresentations)) {
                            $name_pres = strtoupper($dataProdPres['name']);
                            $factor_pres = strtoupper($dataProdPres['factor']);
                            $price_pres = strtoupper($dataProdPres['sale_price']);

                            $pdf->SetFont('times', '', 9);
                            $tbl_head .= <<<EOD
                                <tr>
                                    <td width="60"></td>
                                    <td width="90"></td>
                                    <td width="350"></td>
                                    <td width="140">$name_pres</td>
                                    <td width="60">$factor_pres</td>
                                    <td width="60">$price_pres</td>
                                    <td width="160"></td>
                                    <td width="60"></td>
                                </tr>
                            EOD; 
                        }



                    }else {

                    }



                }

                $tbl_head .= <<<EOD
                    </table>
                    EOD;

                    
                $pdf->writeHTML($tbl_head, true, false, false, false, '');
        }
 
    }


}

$pdf->Output('reporteInventarios.pdf', 'I', 'L');

