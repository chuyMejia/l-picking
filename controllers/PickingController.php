<?php


require_once 'models/picking.php';

class pickingController {

public function index(){



require_once 'views/picking/index.php';

}

public function index2(){



	require_once 'views/picking/index2.php';
	
}


public function index3(){



	require_once 'views/picking/index3.php';
	
}

public function check_(){

    



        $revision = new picking();
        $revision->setId($_GET['RPI']);
        $result = $revision->exist();

        //var_dump($result);

        echo json_encode($result);

        

        die();

}

public function chart(){

    $chart = new picking();
    $exec =  $chart->getchart();

    $chart2 = new picking();
    $exec_semana =  $chart2->getchart_Semana();


   
    

    require_once 'views/picking/chart.php';


	
}

public function detail(){

    $chart2 = new picking();
    $exec_semana =  $chart2->getchart_Semana();

    $data_buscar = new picking();
    $data_buscar->setDel($_POST['de_']);
    $data_buscar->setAl($_POST['hasta_']);
    $data_buscar->setChoice($_POST['opcion']);
    $b_result = $data_buscar->buscar_detail();


   // var_dump($exec_semana[0]);


   var_dump($b_result);

   


    require_once 'views/picking/chart.php';

}


public function chart2(){

    $chart = new picking();
    $exec =  $chart->getchart();


    var_dump($_POST);

    

	require_once 'views/picking/chart2.php';
	
}


    
	



public function reporte(){

    $report = new picking();
    $show =  $report->getAll();

   // var_dump($show);
    //die();
   //1465869
   //1465284
	require_once 'views/picking/reporte.php';
	
}


public function rev(){
    var_dump($_POST);
    die();
  }

  public function check() {
    if(isset($_POST)){
        $picking = new picking();
        $picking->setId($_POST['nPicking']);
        $check = $picking->check();


        // Imprimir el JSON sin espacios en blanco adicionales
        echo json_encode($check);
        die();
    }
}




public function check2(){



   

    if(isset($_POST)){

        $picking = new picking();
        $picking->setId($_POST['nPicking']);
        $check = $picking->check();

        //header('Content-Type: application/json');
        echo json_encode($check);
        //var_dump($check);
        //echo $check;
die();
       // echo $check;

        //die();

        // var_dump($check);
        // die();

        // echo "desde controller acction check";
        // die();

    }



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
        $usuario->setUser($_SESSION['identity']['nombre_usuario']);

       // echo $_SESSION['identity']['nombre_usuario'];

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
public function saveData() {
    // Obtener los datos del cuerpo de la solicitud POST
    $jsonData = json_decode($_POST['jsonData'], true);

	//echo json_encode($jsonData[0]['Clave']);


	//echo json_encode($_GET['RPI']);
	//die();

		
		$RPI = $_GET['RPI'];

	//die();

    // Verificar si hubo un error en la decodificación JSON
    if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
        // Error en la decodificación JSON
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Error en la decodificación JSON']);
        die();
    }

    // Hacer algo con los datos (por ejemplo, recorrer e insertar en la base de datos)
    //$response = $this->processData($jsonData);

	$responses = [];

    foreach ($jsonData as $item) {
        $picking = new Picking();
        $picking->setId($RPI); // Aquí deberías ajustar cómo obtienes el ID
        $picking->setItem($item['Clave']);
        $picking->setCantidad($item['Cant']);
        $picking->setUser($_SESSION['identity']['nombre_usuario']);

       
        //isCorrect
        $picking->setIsCorrect($item['isCorrect']);
      
        $register = $picking->save();
        $responses[] = $register;
    }

    // Enviar una respuesta JSON con los resultados
    echo json_encode(['responses' => $responses]);
    die();
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