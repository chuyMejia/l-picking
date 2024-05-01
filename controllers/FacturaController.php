<?php

//cargando modelo de factura 
require_once 'models/factura.php';

class facturaController {

public function index(){

    $fac_ = new factura;
    $result = $fac_->principal();
    

    require_once 'views/factura/index.php';

}


public function save() {
    $factura = new factura;
    $factura->setId(1); // Parámetro no utilizado
    $factura->setFactura($_GET['FQ']);
    $factura->setUser($_GET['USER']);
    $resultado = $factura->save();
    
    // Verificar si los datos son un arreglo antes de codificar como JSON
    if (is_array($resultado)) {
        header('Content-Type: application/json');
        echo json_encode($resultado);
    } else {
        // Manejar el caso en el que los datos no sean un arreglo
        echo json_encode(array('error' => 'No se encontraron datos válidos.'));
    }
    die();
}



}
?>