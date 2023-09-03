<?php


class Pedido{
	private $id;
	private $usuario_id;
	private $provincia;
	private $localidad;
	private $direccion;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;
	private $db;
	
	public function __construct() {
		$this->db = database::conectar();
	}
	
	function getId() {
		return $this->id;
	}
	function getUsuario_id() {
		return $this->usuario_id;
	}
	function getProvincia() {
		return $this->provincia;
	}
	function getLocalidad() {
		return $this->localidad;
	}
	function getDireccion() {
		return $this->direccion;
	}
	function getCoste() {
		return $this->coste;
	}
	function getEstado() {
		return $this->estado;
	}
	function getFecha() {
		return $this->fecha;
	}
	function getHora() {
		return $this->hora;
	}

	

	function setId($id) {
		$this->id = $id;
	}
	function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}
	function setProvincia($provincia) {
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	function setLocalidad($localidad) {
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	function setCoste($coste) {
		$this->coste = $coste;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	function setHora($hora) {
		$this->hora = $hora;
	}




public function save(){

	$sql = "INSERT INTO pedidos VALUES(NULL,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'CONFIRM',CURDATE(),CURTIME());";

	$save = $this->db->query($sql);

	$result = false;

	if($save){
		$result = true;

	}

	return $result;

}






public function login(){

	$email = $this->email;

	$password = $this->password;


    $result = false;
  
	$sql = "SELECT * FROM usuarios WHERE EMAIL = '$email'";

	$login = $this->db->query($sql);

	if($login && $login->num_rows == 1){

		$usuario = $login->fetch_object();

		//verificar password

		$verify = password_verify($password,$usuario->password);
		if($verify){

			$result = $usuario;

		}


	}
	return $result;



}

public function save_linea(){
      $sql = "SELECT LAST_INSERT_ID() AS 'pedido' ;";
      $query = $this->db->query($sql);
      $pedido_id = $query->fetch_object()->pedido;


      $carrito = $_SESSION['carrito'];
   
	foreach ($carrito as $indice => $elemento) {//recorrer todo el carrto y hacer insert pocada elemento del mismo

        $producto = $elemento['producto'];//accedemos alobjeto producto

		$insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']});";
		$save = $this->db->query($insert);
	}

	if($save){
		$result = true;

	}

	return $result;


}

public function getOneByUser(){


	$sql = "SELECT p.id,p.coste FROM pedidos p "
			//."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id"
			." WHERE usuario_id = {$this->getUsuario_id()} ORDER BY p.id DESC LIMIT 1";
			$producto = $this->db->query($sql);

        /* echo $sql;
         echo "</br>";
         echo $this->db->error;
         die();*/



			return $producto->fetch_object();
}

public function getProductosByPedido($id){

/*	$sql = "SELECT * FROM productos WHERE id IN "
	      ." (SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id})";*/

  $sql = "SELECT pr.*, lp.unidades FROM productos pr "
        ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
        ."WHERE  lp.pedido_id = {$id} ";

/*
  $sql = "SELECT pr.*, lp.unidades FROM productos pr "
				. "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
				. "WHERE lp.pedido_id={$id}";
*/

    $productos = $this->db->query($sql);




       /*  echo $sql;
         echo "</br>";
         echo $this->db->error;
         die();*/



	return $productos;



}



public function getAllByUser(){


	$sql = "SELECT * FROM pedidos p "
			//."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id"
			." WHERE usuario_id = {$this->getUsuario_id()} ORDER BY p.id";
			$producto = $this->db->query($sql);

        /* echo $sql;
         echo "</br>";
         echo $this->db->error;
         die();*/



			return $producto;
}


public function getOne(){

	$sql = "SELECT * FROM pedidos WHERE id = {$this->getId()} "; 

	$producto = $this->db->query($sql);

	return $producto->fetch_object();



}

public function getAll(){
		$productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
		return $productos;
	}



public function edit(){
   

	$sql = "UPDATE pedidos SET estado = '{$this->getEstado()}'";
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




}






