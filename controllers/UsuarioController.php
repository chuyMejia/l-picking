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
		//var_dump($datos);
		die();



}
//http://192.168.1.235/lista-Picking/usuario/registro
//http://192.168.1.235/lista-Picking/usuario/login

public function login(){

	//header('Location:'.base_url.'usuario/login');
	require_once 'views/usuario/login.php';
	//header('Location:'.base_url.'usuario/registro');
}

public function salir (){

	session_destroy();

	header('Location: '.base_url);

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


public function ShowOne(){



	$user = new Usuario();
	$user->setId($_GET['user']);
	$resultado = $user->showOne();
	echo json_encode($resultado);
	die();


}


public function upload_image(){


	
	//var_dump($_FILES);

	//die();

	//recibir dato del id del usuario
	//por get 

	// var_dump($_GET['user']);
	// die();

   //die();

	
	$file = $_FILES['imagen'];
	$filename = $file['name'];
	$mimetype = $file['type'];

	
//C36321   MARIELA TELLIZGON    

	if($mimetype == "image/jpeg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/jpeg" || $mimetype == "image/gif"){//comprambamos el tipo de imagen a subir

		if(!is_dir('uploads/images')){//comprobamos si existe un directorio 
			mkdir('uploads/images',0777,true);

		}  
       $user = new usuario();

	   $user->setId($_GET['userid']);
	   $user->setImagen($filename);
	   

	   $result = $user->update_img();

	//    var_dump($result);
	//    die();

	   //funcion para hacer update sobre la foto

	   

	  ///sube la imagen
	    $_SESSION['identity']['imagen'] = $filename;
		move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
		
			echo "upload correcto";
			die();


	}
}

//////4236872    2204  
////
///
//
//
/*4236964  /-//-//-/  4236906  */

//c96052

}
?>