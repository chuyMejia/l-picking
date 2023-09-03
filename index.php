
<?php

/*
require_once 'controllers/UsuarioController.php';
require_once 'controllers/NotaController.php';

*/

session_start();

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';

require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';




$usuario = new UsuarioController;

//$usuario->crear();
//$usuario->mostarTodos();


function show_error (){

	$error = new errorController();
	$error->index();

}



if (isset($_GET['controller'])){
	$nombrecontrolador = $_GET['controller']."Controller";
	
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

	$nombrecontrolador = controller_default;

}

else{
	echo "webos";
	die();
	show_error();
	exit();
}

if ( class_exists($nombrecontrolador)){


    $controlador = new $nombrecontrolador();

		if(isset($_GET['action']) && method_exists($controlador,$_GET['action'] )){


			$action = $_GET['action'];

			$controlador->$action();
		    //  $controlador->$action();
			//mostar_todos

		}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

             $default_action = action_default;
             $controlador->$default_action();

		}

		else{
		show_error();
		}


}else{

	show_error();

}





require_once 'views/layout/footer.php';




?>