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

//Utils::deleteSession('register');//limpia la variable de sesio si existe

unset($_SESSION['register']);



?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/materialize-css@1.0.0/dist/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/materialize-css@1.0.0/dist/css/materialize.min.css">

<div style ="display:flex;">
		<div class="row" style = "max-width: 45%;">
			<div class="col s12 m6">
			<div class="card  darken-1" >
				<div class="card-content black-text">
				<span class="card-title">Nuevo Registro</span>
				<form  action="<?=base_url?>usuario/save" method="POST">
					<label for="nombre" >Nombre:</label>
					<input type="text" name="nombre" required="">

					<label for="apellidos" >Apellidos:</label>
					<input type="text" name="apellidos" required="">

					<label for="user" >Usuario:</label>
					<input type="text" name="user" required="">

					<label for="password" >Contraseña:</label>
					<input type="password" name="password" required="">
					<input type="submit" value="REGISTRAR">
				</form>
				</div>
			</div>
			</div>
		</div>

		<div class="row" style = "max-width: 45%;">
			<div class="col s12 m6">
			<div class="card  darken-1" >
				<div class="card-content black-text">
				<span class="card-title">Usuarios</span>
				<table border="1" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Nombre de usuario</th>
							<!-- <th>Password</th> -->
							<th>Tipo de usuario</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($datos as $row): ?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['nombre']; ?></td>
								<td><?php echo $row['apellido']; ?></td>
								<td><?php echo $row['nombre_usuario']; ?></td>
								<!-- <td><?php //echo $row['password']; ?></td> -->
								<td><?php echo $row['tipo_usuario']; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				</div>
			</div>
			</div>
		</div>

		
</div>