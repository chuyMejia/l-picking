<?php

require_once 'models/producto.php';
class productoController {

public function index(){

  $producto = new Producto();
  $productos =$producto->getRandom(6);

  //var_dump( $productos->fetch_object()); 


require_once 'views/producto/destacados.php';

}
public function gestionar(){

	Utils::isAdmin();

    $producto = new Producto();
    $productos =  $producto->getAll();


	require_once 'views/producto/gestion.php';
}


public function ver(){
       

    if (isset($_GET['id'])){
     

       $id = $_GET['id'];


        $producto = new Producto;
        $producto->setId($id);
        $product =  $producto->getOne();
      


     
     }

      require_once("views/producto/ver.php");

}





public function crear(){

	Utils::isAdmin();


   

	require_once 'views/producto/crear.php';
}

public function save(){

	Utils::isAdmin();


	if(isset($_POST)){
       
       $nombre = isset($_POST['nombre'])   ? $_POST['nombre'] : false;
       $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
       $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
       $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
       $categoria =  isset($_POST['categoria']) ? $_POST['categoria'] : false;
     //  $image = isset($_POST['image']) ? $_POST['image'] : false;

       if($nombre && !empty($nombre) && $descripcion && $precio && $stock && $categoria){
         $producto = new Producto();
         $producto->setNombre($nombre);
         $producto->setDescripcion($descripcion);
         $producto->setPrecio($precio);
         $producto->setStock($stock);
         $producto->setCategoria_id($categoria);


         //guardar imagen


         $file = $_FILES['imagen'];
         $filename = $file['name'];
         $mimetype = $file['type'];

         if($mimetype == "image/jpeg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/jpeg" || $mimetype == "image/gif"){//comprambamos el tipo de imagen a subir

         	if(!is_dir('uploads/images')){//comprobamos si existe un directorio 
         		mkdir('uploads/images',0777,true);

         	}  
          

            $producto->setImagen($filename);
         	move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
         	



         }

         if(isset($_GET['id'])){

          $id = $_GET['id'];
          
          $producto->setId($id);

          $save = $producto->edit();

         }else{
           $save = $producto->save();

         }

         
         if($save){
         	$_SESSION['PRODUCTO'] = "complete";

         }else{
         	$_SESSION['PRODUCTO'] = "failed";
         }

       }else{
       	$_SESSION['PRODUCTO'] = "failed";
       }
		
	}else{
		$_SESSION['PRODUCTO'] = "failed";
	}

	header('Location: '.base_url.'producto/gestionar'); 
}


public function edit(){
        Utils::isAdmin();
        

    if ($_GET['action'] == 'edit'){
      $edit = true;
    

       $id = $_GET['id'];


      
       if(isset($id)){



        //$id = $_GET['id'];

        $producto = new Producto;
        $producto->setId($id);
        $pro =  $producto->getOne();
       // $pro->fetch_object();


       // var_dump($pro);
       }


      require_once("views/producto/crear.php");
     }






}

public function delete(){

  Utils::isAdmin();
 

//recibir dqatos por get 
 // var_dump($_GET);

  $id = $_GET['id'];


     if(isset($id)){
      $producto = new Producto;
      $producto->setId($id);
     $delete = $producto->delete();
     if($delete){

      $_SESSION['delete']="complete";


     }else{
       $_SESSION['delete']="failed";

     }
      


    }else{
       $_SESSION['delete']="failed";

    }

    header('Location:'.base_url."producto/gestionar");






}


}
?>