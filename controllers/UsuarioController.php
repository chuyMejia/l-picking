<?php


require_once 'models/usuario.php';

class usuarioController {

public function index(){

echo "usuarioController en la Accion INDEX";

}



public function registro(){

			$show_all = new Usuario();
			$datos = $show_all->showAll();
			//var_dump($datos);
			//die();


	require_once 'views/usuario/registro.php';
	
}



public function save(){
	if(isset($_POST)){



      //validacion 

		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; 
		$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
		$user = isset($_POST['user']) ? $_POST['user'] : false;
		$password = isset($_POST['password']) ? $_POST['password'] : false;




		if ($nombre && $apellidos && $user && $password){



		$usuario = new Usuario();
			

		$usuario->setNombre($_POST['nombre']);
		$usuario->setApellidos($_POST['apellidos']);
		$usuario->setUser($_POST['user']);
		$usuario->setPassword($_POST['password']);

		//var_dump($_POST['user']);

		//die();

		$save = $usuario->save();

		if ($save){

			$_SESSION['register'] = 'complete';

		}else{
			
			$_SESSION['register'] = 'failed';
		}

		}else{

			$_SESSION['register'] = 'failed';

		}

	}else{
	$_SESSION['register'] = 'failed';

}
header('Location:'.base_url.'usuario/registro');

}




public function show_all(){

		$show_all = new Usuario();
		$datos = $show_all->showAll();
		var_dump($datos);
		die();



}
//http://192.168.1.235/lista-Picking/usuario/registro
//http://192.168.1.235/lista-Picking/usuario/login

public function login(){

	//header('Location:'.base_url.'usuario/login');
	require_once 'views/usuario/login.php';
	//header('Location:'.base_url.'usuario/registro');
}

public function login_(){




	

	if(isset($_POST)){
         
	//llegan los datos desde el formulario a la accion del cotrolador


		//consulta a base (Modelo)


		$usuario = new Usuario();
     

        $usuario->setUser($_POST['user']);
        $usuario->setPassword($_POST['password']);
		$identity = $usuario->login();

		
		//if($identity && is_object($identity)){
         if($identity){

			// echo json_encode($identity);
		    // die();

         	$_SESSION['identity'] = $identity;

         	if($identity->rol == 'admin'){


         	    $_SESSION['admin'] = true;


         	}

         }else {

         	$_SESSION['error_login'] = "identificacion FALLO";
         }



		//echo "webos";

		//Crear session 
		

	}
	header('Location: '.base_url);




}





public function logout(){
 

  if(isset($_SESSION['identity'])){

  	unset($_SESSION['identity']);

  }

  if(isset($_SESSION['admin'])){

  	unset($_SESSION['admin']);

  }

  header('Location:'.base_url);

}





}
?>