<?php 

session_start();
require  ("../model/products_model.php"); 

/* Get var by POST to execute an action  */
$action_perform = $_POST['action'];

/* ***********************  AREA DE PRODCUTOS ********************** */
if ($action_perform == "listDataProduct") {
    echo json_encode(PRODUCTS::listDataProducts());

}else if ($action_perform == "listDataProductSearch") {
    $data = $_POST['info'];
    echo json_encode(PRODUCTS::listDataProductSearch($data)); 

}else if ($action_perform == "listDataProductItem") {
    $data = $_POST['item'];
    echo json_encode(PRODUCTS::listDataProductItem($data)); 
}else if ($action_perform == "searchProductName") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::searchProductName($id));
}else if ($action_perform == "listDataToBarCode") {
    $bar_code = trim($_POST['bar_code']);
    echo json_encode(PRODUCTS::listDataToBarCode($bar_code));
}else if ($action_perform == "listDataToBarCodePres") {
    $bar_code = trim($_POST['bar_code']);
    echo json_encode(PRODUCTS::listDataToBarCodePres($bar_code));
}else if ($action_perform == "listDataToPresentation") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataToPresentation($id));
    
}else if ($action_perform == "listDataProductToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataProductToId($id));
}else if ($action_perform == "validateCodProduct") {
    $cod = $_POST['cod'];
    echo json_encode(PRODUCTS::validateCodProduct($cod));
}else if ($action_perform == "listDataToName") {
    $name = $_POST['name'];
    echo json_encode(PRODUCTS::listDataToName($name));

    
}else if ($action_perform == "listDataProductsPresentations") {
        $id = $_POST['id'];
        echo json_encode(PRODUCTS::listDataProductsPresentations($id));
} else if($action_perform == "insertProduct"){
    $data = array(


        'id' => $_POST['id'],
        'cod' => $_POST['codigo'],
        'bar_code' => trim($_POST['codigo_barra']),
        'id_rub' => $_POST['id_rub'],
        'id_group' => $_POST['id_grupo'],
        'id_subgroup' => $_POST['id_subgrupo'],
        'id_vendor' => $_POST['id_proveedor'],
        'id_laboratorie' => $_POST['id_lab'],
        'id_location' => $_POST['id_ubicacion'],
        'id_sub_location' => $_POST['id_ubicacion_2'],
        'id_presentation' => $_POST['id_presentacion'],
        'name' => $_POST['nombre'],
        'sale_price' => $_POST['precio_v1'],
        'sale_price_1' => $_POST['precio_v2'],
        'cost' => $_POST['precio_costo'],
        'wholesalers_price' => $_POST['precio_mayoreo'],
        'description' => $_POST['descripcion'],  
        'status_product' => $_POST['state'],
        'model' => $_POST['modelo'],
        'version' => $_POST['version'],
        'stk_min' => $_POST['stk_min'],
        'stk_med' => $_POST['stk_med'],
        'stk_max' => $_POST['stk_max'],
        'include_IVA' => $_POST['precio_iva'], 
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PRODUCTS::insertProduct($data);
    }else{
         echo PRODUCTS::updateProduct($data);
    }

}else if ($action_perform == "deleteProduct") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteProduct($id));
}else if ($action_perform == "generateCodProduct") {
    $table = $_POST['table'];
    echo json_encode(PRODUCTS::generateCodProduct($table));

}else if ($action_perform == "list_cashier") {
    echo json_encode(PRODUCTS::list_cashier());
}else if ($action_perform == "list_moneybox") {
        echo json_encode(PRODUCTS::list_moneybox());
}else if ($action_perform == "list_tipeof_pay") {
        echo json_encode(PRODUCTS::list_tipeof_pay());
}else if ($action_perform == "list_documents") {
    $type = $_POST['type'];
        echo json_encode(PRODUCTS::list_documents($type));
}else if ($action_perform == "list_clients") {
        echo json_encode(PRODUCTS::list_clients());
}else if ($action_perform == "list_proveedores") {
        echo json_encode(PRODUCTS::list_proveedores());
}else if ($action_perform == "obtenerDataDocument") {
    $id = $_POST['id'];
        echo json_encode(PRODUCTS::obtenerDataDocument($id));
}else if ($action_perform == "obtenerDataDocument_error") {
    $id = $_POST['id'];
        echo json_encode(PRODUCTS::obtenerDataDocument_error($id));
                 
            
        
/* ***********************  AREA DE GRUPOS ********************** */
}else if ($action_perform == "listDataGroup") {
    echo json_encode(PRODUCTS::list_data_gruops());

}else if ($action_perform == "listDataGroupToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataGroupToId($id));

} else if($action_perform == "insertGroup"){
    $data = array(
        'id' => $_POST['id'],
        'id_rub' => $_POST['id_rub'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
        'description' => $_POST['descripcion'],  
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PRODUCTS::insertGroup($data);
    }else{
         echo PRODUCTS::updateGroup($data);
    }

}else if ($action_perform == "deleteGroup") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteGroup($id));


/**************************************************************** */


/* ***********************  AREA DE SUB-GRUPOS ********************** */
}else if ($action_perform == "listDataSubGroup") {
    echo json_encode(PRODUCTS::list_data_subgruops());

}else if ($action_perform == "listDataSubGroupToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataSubGroupToId($id));

} else if($action_perform == "insertSubGroup"){
    $data = array(
        'id' => $_POST['id'],
        'id_group' => $_POST['id_grupo'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PRODUCTS::insertSubGroup($data);
    }else{
         echo PRODUCTS::updateSubGroup($data);
    }

}else if ($action_perform == "deleteSubGroup") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteSubGroup($id));


/**************************************************************** */

/* ***********************  AREA DE LABORATORIOS ********************** */
}else if ($action_perform == "listDataLaboratories") {
    echo json_encode(PRODUCTS::list_data_laboratories());

}else if ($action_perform == "listDataLaboratoriesToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataLaboratoriesToId($id));

} else if($action_perform == "insertLaboratories"){
    $data = array(
        'id' => $_POST['id'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
        'description' => $_POST['descripcion'],
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PRODUCTS::insertLaboratories($data);
    }else{
         echo PRODUCTS::updateLaboratories($data);
    }

}else if ($action_perform == "deleteLaboratories") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteLaboratories($id));


/**************************************************************** */


/* ***********************  AREA DE UBICACIONES ********************** */
}else if ($action_perform == "listDataLocations") {
    echo json_encode(PRODUCTS::list_data_locations());

}else if ($action_perform == "listDataLocationsToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataLocationsToId($id));

} else if($action_perform == "insertLocations"){
    $data = array(
        'id' => $_POST['id'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
        'description' => $_POST['descripcion'],
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PRODUCTS::insertLocations($data);
    }else{
         echo PRODUCTS::updateLocations($data);
    }

}else if ($action_perform == "deleteLocations") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteLocations($id));


/**************************************************************** */


/* ***********************  AREA DE RUBROS ********************** */
}else if ($action_perform == "listDataRub") {
    echo json_encode(PRODUCTS::list_data_rubs()); 

}else if ($action_perform == "listDataRubToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataRubToId($id));

} else if($action_perform == "insertRub"){
    $data = array(
        'id' => $_POST['id'],
        'cod' => $_POST['codigo'],
        'name' => $_POST['nombre'],
        'description' => $_POST['descripcion'],  
    );

    $id = $_POST['id'];
    if (empty($id)) {
        echo PRODUCTS::insertRub($data);
    }else{
         echo PRODUCTS::updateRub($data);
    }

}else if ($action_perform == "deleteRub") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteRub($id));


/**************************************************************** */


/* ***********************  AREA DE LOTES ********************** */
}else if ($action_perform == "listDataLots") {
    $id = $_POST['id_product'];
    echo json_encode(PRODUCTS::listDataLots($id)); 

}else if ($action_perform == "listDataLotsToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataLotsToId($id));

} else if($action_perform == "insertLots"){
    $data = array(
        'id' => $_POST['id_lot'],
        'id_produt' => $_POST['id_product_lot'],
        'lot' => $_POST['num_lot'],
        'cant' => $_POST['cant_lot'],
        'date_lote' => $_POST['fecha_lot'],
        'date_expiration' => $_POST['vence_lot'],  
    );

    $id = $_POST['id_lot'];
    if (empty($id)) {
        echo PRODUCTS::insertLots($data);
    }else{
         echo PRODUCTS::updateLots($data);
    }

}else if ($action_perform == "deleteLots") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deleteLots($id));


/**************************************************************** */



/* ***********************  AREA DE LOTES ********************** */
}else if ($action_perform == "listDataPresentations") {
    $id = $_POST['id_product'];
    echo json_encode(PRODUCTS::listDataPresentations($id)); 

}else if ($action_perform == "listDataPresentationsToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataPresentationsToId($id));

} else if($action_perform == "insertPresentations"){
    $data = array(
        'id' => $_POST['id_pres'],
        'id_produt' => $_POST['id_product_pres'],
        'name' => $_POST['name_pres'],
        'barcode' => trim($_POST['barcode_pres']),
        'factor' => $_POST['factor_pres'],
        'sale_price' => $_POST['precio_pres'], 
        'precio_presS' => $_POST['precio_presS'],
    );

    $id = $_POST['id_pres'];
    if (empty($id)) {
        echo PRODUCTS::insertPresentations($data);
    }else{
         echo PRODUCTS::updatePresentations($data);
    }


} else if($action_perform == "updateCostProduct"){
    $data = array(
        'id' => $_POST['id'],
        'cost' => $_POST['cost'],
    );
    echo PRODUCTS::updateCostProduct($data);

} else if($action_perform == "mostrarVentasNormales"){
    echo json_encode(PRODUCTS::mostrarVentasNormales());
    
} else if($action_perform == "mostrarVentasBajo"){
    echo json_encode(PRODUCTS::mostrarVentasBajo());
    

} else if($action_perform == "updatePrecioProduct"){
    $data = array(
        'id' => $_POST['id'],
        'precio' => $_POST['precio'],
    );
    echo PRODUCTS::updatePrecioProduct($data);


} else if($action_perform == "updatePrecioSugProduct"){
    $data = array(
        'id' => $_POST['id'],
        'precio' => $_POST['precio'],
    );
    echo PRODUCTS::updatePrecioSugProduct($data);
    
    
}else if ($action_perform == "deletePresentations") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::deletePresentations($id));


/**************************************************************** */

}else if ($action_perform == "list_groups") {
    echo json_encode(PRODUCTS::list_groups());

}else if ($action_perform == "list_vendors") {
    echo json_encode(PRODUCTS::list_vendors());

}else if ($action_perform == "listDataProductToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataProductToId($id));

}else if ($action_perform == "list_status") {
    echo json_encode(PRODUCTS::list_status());

}else if ($action_perform == "list_rubs") {
    echo json_encode(PRODUCTS::list_rubs());

}else if ($action_perform == "list_laboratories") {
    echo json_encode(PRODUCTS::list_laboratories());

}else if ($action_perform == "list_locations") {
    echo json_encode(PRODUCTS::list_locations());

}else if ($action_perform == "list_sub_locations") {
    echo json_encode(PRODUCTS::list_sub_locations());

}else if ($action_perform == "list_subgroupToGroup") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::list_subgroupToGroup($id));

}else if ($action_perform == "list_groupsToRub") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::list_groupsToRub($id));

}else if ($action_perform == "list_cashiers") {
    echo json_encode(PRODUCTS::list_cashiers());
}else if ($action_perform == "list_cashier") {
    echo json_encode(PRODUCTS::list_cashier());

}else if ($action_perform == "readExistences") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::readExistences($id));
}else if($action_perform == "list_data_invoices") {
    echo json_encode(PRODUCTS::list_data_invoices());
}else if ($action_perform == "list_data_invoicesWhere") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::list_data_invoicesWhere($id));
    
}else if ($action_perform == "list_data_invoiceDetails") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::list_data_invoiceDetails($id));
    
}





else if ($action_perform == "UpdateExistences") {

    $data = array(
        'id' => $_POST['id_existen'],
        'id_product' => $_POST['id_product'],
        'cant' => $_POST['cantidad'],
    );

    echo PRODUCTS::UpdateExistences($data);
    
}else if ($action_perform == "insertExistences") {

    $data = array(
        'id_product' => $_POST['id_product'],
        'cantidad' => $_POST['cantidad'],
    );

    echo PRODUCTS::insertExistences($data);

}else if ($action_perform == "listDataProductsToId") {
    $id = $_POST['id'];
    echo json_encode(PRODUCTS::listDataProductsToId($id));

/* ACTIONS INVOICES */

}else if ($action_perform == "discount_inventory") {
    $id_product = $_POST['id_prod'];
    $factor = $_POST['factor'];
    echo json_encode(INVOICE::discount_inventory($id_product, $factor));
    
}else if ($action_perform == "insertInvoiceHead") {

    $detalle = array(
        'id_product' => $_POST['idProduct'],
        'name' => $_POST['nameProduct'],
        'presentation' => $_POST['presentationProduct'],
        'cant' => $_POST['cantProduct'],
        'factor' => $_POST['factorProduct'],
        'sale_price' => $_POST['priceProduct'],
        'sale_price_suggested' => $_POST['priceSugProduct'],
    );

    $encabezado = array(
        'number_transacction' => $_POST['number_transacction'],
        'id_document' => $_POST['id_document'],
        'date' => $_POST['date'],
        'state' => $_POST['state'],
        'id_client' => $_POST['id_client'],
        'id_seller' => $_POST['id_seller'], 
        'id_casher' => $_POST['id_casher'], 
        'id_tyofpay' => $_POST['id_tyofpay'], 
        'state' => $_POST['state'], 
        'total_document' => $_POST['total_document'], 
        'total_documentDesc' => $_POST['total_documentDesc'], 
        'mount' => $_POST['mount'],
        'cash' => $_POST['cash'],
        'desc_receta' => $_POST['desc_receta'],
        'desc_compras' => $_POST['desc_compras'],
    );
    echo json_encode(INVOICE::insertInvoice($encabezado, $detalle)); 


/* ACTIONS QUOTES */

}else if ($action_perform == "aument_inventory") {
    $id_product = $_POST['id_prod'];
    $factor = $_POST['factor'];
    echo json_encode(QUOTES::aument_inventory($id_product, $factor));
    
}else if ($action_perform == "insertQuotesHead") {

    $detalle = array(
        'id_product' => $_POST['idProduct'],
        'name' => $_POST['nameProduct'],
        'presentation' => $_POST['presentationProduct'],
        'cant' => $_POST['cantProduct'],
        'factor' => $_POST['factorProduct'],
        'costo' => $_POST['costProduct'],
        'sale_price' => $_POST['priceProduct'],
        'sale_price_suggested' => $_POST['priceSugProduct'],
    );

    $encabezado = array(
        'number_transacction' => $_POST['number_transacction'],
        'date' => $_POST['date'],
        'number_of_document' => $_POST['number_of_document'],
        'id_seller' => $_POST['id_seller'], 
        'id_document' => $_POST['id_document'],
        'id_tyofpay' => $_POST['id_tyofpay'], 
        'state' => $_POST['state'], 
        'total_document' => $_POST['total_document'], 
        'final_date' => $_POST['final_date'],
     

    );
    echo json_encode(QUOTES::insertQuotesHead($encabezado, $detalle)); 
} else{

}








?>