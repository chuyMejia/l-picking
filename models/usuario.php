<?php


class Usuario{
	private $id;
	private $nombre;
	private $apellidos;
	private $user;
	private $password;
	private $rol;
	private $imagen;
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

	function getApellidos() {
		return $this->apellidos;
	}

	function getUser() {
		return $this->user;
	}

	function getPassword() {
		return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		//$this->nombre = $this->db->quote($nombre);
		$this->nombre = $nombre;
	}

	function setApellidos($apellidos) {
		//$this->apellidos = $this->db->quote($apellidos);
		$this->apellidos = $apellidos;
	}

	function setUser($user) {
		//$this->user = $this->db->quote($user);
		$this->user = $user;
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}



public function save_respaldo(){

	$sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','USER',NULL);";

	$save = $this->db->query($sql);

	$result = false;
	if($save){
		$result = true;

	}

	return $result;

}


public function savesss() {
    // Preparar la consulta SQL con parámetros
    $sql = "INSERT INTO usuarios (nombre, apellido, nombre_usuario, password, tipo_usuario) 
            VALUES (:nombre, :apellido, :nombre_usuario, :password, :tipo_usuario)";
    
    // Preparar los datos para el INSERT
    $datos = array(
        ':nombre' => $this->getNombre(),
        ':apellido' => $this->getApellidos(),
        ':nombre_usuario' => $this->getUser(),
        ':password' => $this->getPassword(),
        ':tipo_usuario' => 'USER'
    );
    
	$result = sqlsrv_query($this->db, $sql);

    // Verifica si la consulta fue exitosa
    if ($result === false) {
        // Manejar el error si la consulta falla
        throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
    }

    // Almacena los resultados en un array
    $rows = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }

    // Cierra la conexión
    sqlsrv_close($this->db);

    // Retorna los resultados
    return $rows;
}

public function save() {
    try {
        // Preparar la consulta SQL con parámetros
        $sql = "INSERT INTO usuarios_picking (nombre, apellido, nombre_usuario, password, tipo_usuario) 
                VALUES (?, ?, ?, ?, ?)";
        
        // Obtener los valores de las propiedades
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $user = $this->getUser();
        $password = $this->getPassword();
        $tipo_usuario = "USER";

        // Preparar la consulta con sqlsrv_prepare
        $consulta = sqlsrv_prepare($this->db, $sql, array(
            &$nombre,
            &$apellidos,
            &$user,
            &$password,
            &$tipo_usuario
        ));

        // Ejecutar la consulta
        $resultado = sqlsrv_execute($consulta);

		$result = false;
	if($resultado){
		$result = true;

	}
	


	return $result;

        // Verificar si el INSERT fue exitoso
        if ($resultado === false) {
            // Manejar el error si la consulta falla
            throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
        }

        // Retorna true si la consulta se ejecutó correctamente
        return true;
    } catch (Exception $e) {
        // Manejar errores si ocurren
        echo "Error al ejecutar la consulta: " . $e->getMessage();
        return false;
    }
}





public function showAll() {
	// Consulta SQL
	$sql = 'SELECT  * FROM usuarios_picking;';

	// Ejecuta la consulta usando la conexión existente
	$result = sqlsrv_query($this->db, $sql);

	// Verifica si la consulta fue exitosa
	if ($result === false) {
		// Manejar el error si la consulta falla
		throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
	}

	// Almacena los resultados en un array
	$rows = array();
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$rows[] = $row;
	}

	// Cierra la conexión
	sqlsrv_close($this->db);

	// Retorna los resultados
	return $rows;
}








public function login(){
    $user = $this->user;
    $password = $this->password;

    $result = false;
  
    // Preparar la consulta SQL
    $sql = "SELECT * FROM usuarios_picking WHERE nombre_usuario = ?";
    
    // Preparar los parámetros para la consulta
    $params = array($user);

    // Ejecutar la consulta
    $login = sqlsrv_query($this->db, $sql, $params);

    // Verificar si la consulta fue exitosa
    if ($login === false) {
        // Manejar el error si la consulta falla
        echo "Error en la consulta: " . print_r(sqlsrv_errors(), true);
        return false;
    }

    // Obtener el resultado de la consulta
    $row = sqlsrv_fetch_array($login, SQLSRV_FETCH_ASSOC);

    // Verificar si se encontró un usuario con el nombre de usuario proporcionado
    if ($row !== false) {
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // La contraseña coincide, devolver el usuario
            $result = $row;
        }
    }

    // Cerrar la conexión
    sqlsrv_close($this->db);

	
    return $result;

	die();
}







}