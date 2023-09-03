<?php




class Categoria{
	private $id;
	private $nombre;
	private $db;
	
	public function __construct() {
		$this->db = database::conectar();
	}

	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	public function getAll(){
  
        $sql = 'SELECT * FROM categorias;';

		$categorias = $this->db->query($sql);



		return $categorias;

        

	}


	public function getOne(){
  
        $sql = "SELECT * FROM categorias WHERE id = {$this->getId()} ;";

		$categoria = $this->db->query($sql);

		return $categoria->fetch_object();

        

	}

	public function save(){
          
     $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}');";

	$save = $this->db->query($sql);

	$result = false;
	if($save){
		$result = true;
	}
	return $result;

	}

	public function delete(){
          
   //  $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}');";

     $sql = "DELETE FROM categorias WHERE id = {$this->getId()} ;";



	$save = $this->db->query($sql);


        /* echo $sql;
         echo "</br>";
         echo $this->db->error;
         die();*/

	$result = false;
	if($save){
		$result = true;



	}

	return $result;



	}





	}
?>