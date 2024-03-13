
<?php

/*
require_once 'controllers/UsuarioController.php';
require_once 'controllers/NotaController.php';

*/
require_once 'controllers/UsuarioController.php';
session_start();




require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';

//require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
//require_once 'views/layout/sidebar.php';
// Incluir la clase Database


// Conectar a la base de datos
// $conn = Database::conectar();

// // Realizar la consulta para verificar la conexión
// $query = "SELECT 1";
// $result = sqlsrv_query($conn, $query);

// if ($result === false) {
//     die(print_r(sqlsrv_errors(), true));
// }

// // Verificar si se obtuvo un resultado
// if (sqlsrv_has_rows($result)) {
//     //echo "La conexión fue exitosa y se obtuvo un resultado.".$result;
// 	var_dump($result);
// } else {
//     //echo "La conexión fue exitosa, pero no se obtuvo ningún resultado.";
// }

// Cerrar la conexión cuando hayas terminado
//Database::cerrarConexion();

//die();

$usuario = new UsuarioController;

//$usuario->crear();
//$usuario->mostarTodos();


/*
var_dump($_GET);
die();
*/




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
//echo "-----------------------------";

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


}





require_once 'views/layout/footer.php';




?>