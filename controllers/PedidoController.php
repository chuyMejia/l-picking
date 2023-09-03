<?php
require_once 'models/pedido.php';

class pedidoController {

public function index(){

//echo "pedidoController en la Accion INDEX";

require_once 'views/pedido/hacer.php';


}
public function add(){

	//var_dump($_POST);
	//die();

//	var_dump($usuario_id);
   //  die();	
	//si el usuario esta idrtificao guardar datos


	if(isset($_SESSION['identity'])){
		//guardar datos en bd
		$usuario_id = $_SESSION['identity']->id;
		$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
		$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
		$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
		$stats = Utils::statsCarrito();
		$coste = $stats['total']; 

	/*	var_dump($stats);
		die();*/
		if($provincia && $localidad && $direccion){
			$pedido = new Pedido;
			$pedido->setUsuario_id($usuario_id);
			$pedido->setProvincia($provincia);
			$pedido->setLocalidad($localidad);
			$pedido->setDireccion($direccion);
			$pedido->setCoste($coste);
			$save = $pedido->save();
			$save_linea = $pedido->save_linea();

			if($save && $save_linea){

				$_SESSION['pedido'] = 'complete';
			}else{

				$_SESSION['pedido'] = 'failed';
			}

		}else{

          $_SESSION['pedido'] = 'failed';

		}

		header('Location:'.base_url."pedido/confirmado");


		


	}else{

        //si no esta identificado redirige al ndex
		header("Location:".base_url);
	}




}

public function confirmado(){
	if($_SESSION['identity']){

       	$usuario_id = $_SESSION['identity'];

		$pedido = new Pedido();
		$pedido->setUsuario_id($usuario_id->id);
		$pedido = $pedido->getOneByUser();

		$pedido_producto = new Pedido();
		$productos = $pedido_producto->getProductosByPedido($pedido->id);



	}


	require_once 'views/pedido/confirmado.php';
}

public function misPedidos(){
	//identifica si el usuario esta logueado
	Utils::isLoged();
    //hacer peticion a el modelo 
  // echo $SESSION['identity'];

  // $user =  $_SESSION['identity']->id
  //  die();
	$usuario_id = $_SESSION['identity'];

    $pedido = new Pedido();
    $pedido->setUsuario_id($usuario_id->id);
    $pedidos =  $pedido->getAllByUser();




 	require_once 'views/pedido/mis_pedidos.php';

}

public function detalle(){

	Utils::isLoged();
	if(isset($_GET['id'])){

		$id = $_GET['id'];

		//sacar pedido
		$pedido = new Pedido();
		$pedido->setId($id);
		$pedido = $pedido->getOne();


		//sacar los productos
       $pedido_producto = new Pedido();
       $productos = $pedido_producto->getProductosByPedido($id);

       require_once 'views/pedido/detalle.php';


	}else{
      
      header('Location:'.base_url.'views/pedido/mis_pedidos.php');
	}


	
	
}

public function gestionar(){

	Utils::isAdmin();
	$gestion = true;

	$pedidos = new Pedido();
    $pedidos = $pedidos->getAll();

require_once 'views/pedido/mis_pedidos.php';

}

public function estado(){

	if(isset($_POST) &&  isset($_POST['id_prod']) &&  isset($_POST['estado'])){

      $id_prod = $_POST['id_prod'];
      $new_estado = $_POST['estado'];

     /* var_dump($_POST);
      die();*/

        $pedido = new Pedido;
        $pedido->setId($id_prod);
        $pedido->setEstado($new_estado);
        $pedido =  $pedido->edit();


     header('Location:'.base_url.'pedido/detalle&id='.$id_prod);

	}else{

	}



}








     
 


     
     




}



?>