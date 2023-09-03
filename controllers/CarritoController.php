<?php

require_once 'models/producto.php';


class carritoController {

public function index(){

       // echo "CARRITO INDEX";
	 if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){

		$carrito = $_SESSION['carrito'];
}else{

	$carrito = array();
}


require_once 'views/carrito/index.php';

}

public function add(){
	if(isset($_GET['id'])){
			$producto_id = $_GET['id'];
		}else{
			header('Location:'.base_url);
		}
		
		if(isset($_SESSION['carrito'])){
			$counter = 0;
			foreach($_SESSION['carrito'] as $indice => $elemento){
				if($elemento['id_producto'] == $producto_id){
					$_SESSION['carrito'][$indice]['unidades']++;
					$counter++;
				}
			}	
		}
		
		if(!isset($counter) || $counter == 0){
			// Conseguir producto
			$producto = new Producto();
			$producto->setId($producto_id);
			$producto = $producto->getOne();

			// Añadir al carrito
			if(is_object($producto)){
				$_SESSION['carrito'][] = array(
					"id_producto" => $producto->id,
					"precio" => $producto->precio,
					"unidades" => 1,
					"producto" => $producto
				);
			}
		}
		
		header("Location:".base_url."carrito/index");



	/*

	if(isset($_GET['id'])){

		$productt_id = $_GET['id'];

	}else{

		header('Location:'.base_url);

	}



	if(isset($_SESSION['carrito'])){

		
	
		$counter = 0;



		foreach ($_SESSION['carrito'] as $indice => $elemento) {
			//echo $_SESSION['carrito'];
			//die();
			if($elemento['id_producto'] == $productt_id){

				$_SESSION['carrito'][$indice]['unidadades']++;

			
     				$counter++;

			}
			
		}
	}else{
		            $producto = new Producto();
		            $producto->setId($productt_id);
		            $producto = $producto->getOne();

		            if(is_object($producto)){

					$_SESSION['carrito'][] = array (
     						"id_producto" => $producto->id,
     						"precio" => $producto->precio,
     						"unidadades" => 1,
     						"producto" => $producto


					); 
				}

	}



		header('Location:'.base_url."carrito/index");


*/


}
public function remove(){

	
}
public function delete(){

	if(isset($_GET) && isset($_GET['index']) ){
		
		$erase = $_GET['index'];

		unset($_SESSION['carrito'][$erase]);


	}

	header('Location:'.base_url."carrito/index");
}


public function delete_All(){


	unset($_SESSION['carrito']);
	header('Location:'.base_url."carrito/index");

}


public function up(){
	if(isset($_GET) && isset($_GET['index']) ){
		
		$index = $_GET['index'];

		$_SESSION['carrito'][$index]['unidades']++;


	}


	header('Location:'.base_url."carrito/index");


}
public function down(){
	if(isset($_GET) && isset($_GET['index']) ){
		
		$index = $_GET['index'];

		$_SESSION['carrito'][$index]['unidades']--;
		if($_SESSION['carrito'][$index]['unidades'] == 0 ){

			unset($_SESSION['carrito'][$index]);

		}


	}



	header('Location:'.base_url."carrito/index");

	
}


}
?>