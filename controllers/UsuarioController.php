<?php


require_once 'models/usuario.php';

class usuarioController {

public function index(){

echo "usuarioController en la Accion INDEX";

}



public function registro(){

	require_once 'views/usuario/registro.php';
	
}



public function save(){
	if(isset($_POST)){



      //validacion 

		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; 
		$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
		$email = isset($_POST['email']) ? $_POST['email'] : false;
		$password = isset($_POST['password']) ? $_POST['password'] : false;




		if ($nombre && $apellidos && $email && $password){



		$usuario = new Usuario();
		$usuario->setNombre($_POST['nombre']);
		$usuario->setApellidos($_POST['apellidos']);
		$usuario->setEmail($_POST['email']);
		$usuario->setPassword($_POST['password']);

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


public function login(){

	if(isset($_POST)){
         
	//llegan los datos desde el formulario a la accion del cotrolador


		//consulta a base (Modelo)


		$usuario = new Usuario();
     

        $usuario->setEmail($_POST['email']);
        $usuario->setPassword($_POST['password']);
		$identity = $usuario->login();

		//var_dump($identity);
		//die();

         if($identity && is_object($identity)){

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