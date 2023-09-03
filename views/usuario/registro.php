<?php


if(isset($_SESSION['register'])){

	if ( $_SESSION['register'] == 'complete'){

		echo "<strong style='color:green;'>REGISTRO GUARDADO CORRECTAMENTE</strong>";
	}else if ( $_SESSION['register'] == 'failed'){
		echo "<strong style='color:red;'>REGISTRO FALLO </strong>";
	}else{
		echo "<strong style='color:red;'>REGISTRO FALLO </strong>";

	}

}

Utils::deleteSession('register');//limpia la variable de sesio si existe

?>

<h2>REGISTRO DE USUARIO NUEVO</h2>

<form  action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre" >Nombre:</label>
	<input type="text" name="nombre" required="">

	<label for="apellidos" >Apellidos:</label>
	<input type="text" name="apellidos" required="">

	<label for="email" >Email::</label>
	<input type="email" name="email" required="">

	<label for="password" >Contraseña:</label>
	<input type="password" name="password" required="">
	<input type="submit" value="REGISTRAR">
</form>