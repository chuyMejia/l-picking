<?php


require_once 'models/categoria.php';
require_once 'models/producto.php';


class categoriaController {

public function index(){
	Utils::isAdmin();

    $categoria = new Categoria();
    $categorias =  $categoria->getAll();


require_once 'views/categorias/index.php';

//echo "categoriaController en la Accion INDEX";

}
public function ver (){


	 if (isset($_GET['id'])){

	 	$id = $_GET['id'];

	 	$categoria = new Categoria();
	 	$categoria->setId($id);
	 	$categoria = $categoria->getOne();

	 	$produto = new Producto();
	 	$produto->setCategoria_id($id);
	 	$productos = $produto->getAllCategory();



	 }


	require_once 'views/categorias/ver.php';

}



	public function crear(){
         Utils::isAdmin();

		require_once 'views/categorias/crear.php';

			
		}


	public function save(){
		Utils::isAdmin();




         if(isset($_POST['nombre'])){



		//GUARDAR 
        $categoria = new Categoria();
        $categoria->setNombre($_POST['nombre']);
        $save = $categoria->save();


         }


       //REDIRIGUIR DESPUES DE GUARDAR 
		header('Location:'.base_url."categoria/index");
	}	


	public function delete(){

		Utils::isAdmin();
        if(isset($_GET['elimina'])){
        $id = 	$_GET['elimina'];
		$categoria = new Categoria();
        $categoria->setId($id);
        $delete = $categoria->delete();
         if($delete == false){
         	
            $_SESSION['cat_error'] = "no se pudo borrar";

         }
        

        }  
         

		header('Location:'.base_url."categoria/index");


	}

}
?>