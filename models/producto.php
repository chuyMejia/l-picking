<?php



class Producto{
	private $id;
	private $categoria_id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;
	private $oferta;
	private $fecha;
	private $imagen;
	private $db;
	
	public function __construct() {
		$this->db = database::conectar();
	}
	
	function getId() {
		return $this->id;
	}
	function getCategoria_id() {
		return $this->categoria_id;
	}

	function getNombre() {
		return $this->nombre;
	}
	function getDescripcion() {
		return $this->descripcion;
	}
	function getPrecio() {
		return $this->precio;
	}
	function getStock() {
		return $this->stock;
	}
	function getOferta(){
		return $this->$oferta;
	}
	function getFecha(){
		return $this->$fecha;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}
	function setCategoria_id($categoria_id) {
		$this->categoria_id = $categoria_id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}
	function setPrecio($precio) {
		$this->precio = $this->db->real_escape_string($precio);
	}
	function setStock($stock) {
		$this->stock = $this->db->real_escape_string($stock);
	}
	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
		function setImagen($imagen) {
		$this->imagen = $imagen;
	}


   public function getAll(){


   	    $sql = 'SELECT * FROM productos;';

		$productos = $this->db->query($sql);

		return $productos;

   }

      public function getAllCategory(){


   	    $sql = "SELECT p.*,c.nombre as C_NOMBRE FROM productos p"
   	    ." INNER JOIN categorias c ON (c.id = p.categoria_id)"
   	    ." WHERE p.categoria_id = {$this->getCategoria_id()}"
   	    ." ORDER BY id DESC";

   	   



		$productos = $this->db->query($sql);

		return $productos;

   }

   public function getRandom($limit){

   	$query = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
   	$productos = $this->db->query($query);

		return $productos;


   }




    public function getOne(){


   	    $sql = "SELECT * FROM productos WHERE id = {$this->getId()};";

   	    

		$producto = $this->db->query($sql);

		$product = $producto->fetch_object();

		return $product;

   }

   public function save(){
   

	$sql = "INSERT INTO productos VALUES(NULL,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},null,CURDATE()
	,'{$this->getImagen()}');";

	$save = $this->db->query($sql);

	//echo $this->db->error;
	//die();

	$result = false;
	if($save){
		$result = true;

	}

	return $result;

}
public function edit(){
   

	$sql = "UPDATE productos SET nombre = '{$this->getNombre()}',categoria_id =  {$this->getCategoria_id()},descripcion = '{$this->getDescripcion()}',precio = {$this->getPrecio()},stock = {$this->getStock()}";

	if($this->getImagen() != null ){

	$sql.=",image = '{$this->getImagen()}'";
       }
    $sql.=" WHERE id = {$this->getId()};";

   

	$save = $this->db->query($sql);

	//echo $this->db->error;
	//die();

	$result = false;
	if($save){
		$result = true;

	}

	return $result;

}

public function delete(){

//sentencia mysql
	$sql =  "DELETE FROM productos WHERE id =  {$this->id}";
	$delete = $this->db->query($sql);//eje4curtamos la consulta

	$delete = false;
	if($delete){
		$delete = true;

	}

	return $delete;




}



}

?>