
	<?php 
	
	//var_dump($_SESSION['identity']);
	if(isset($_GET['TVR'])){
	}else{		//var_dump($_SESSION['identity']);
	 ?>
	 <!DOCTYPE html>
<html lang="es">
<head>
	<title>download</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css">
	<meta charset="utf-8">
	<link href="<?=base_url?>assets/bootstrap-4.0.0/assets/css/docs.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url?>assets/bootstrap-4.0.0/dist/css/bootstrap.min.css">

	
</head>
<!-- <body>
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script> -->

<script src="<?=base_url?>assets/dependencies/js/jquery-3.6.4.slim.min.js"></script>
<script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/jquery-3.6.0.min.js"></script>
<script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

<script src="<?=base_url?>assets/dependencies/js/popper.min.js"></script>

	  <!-- Incluir Popper.js -->
	  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
  <!-- Incluir jQuery (necesario para Bootstrap) -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- Incluir Bootstrap JS -->
<script src="<?=base_url?>assets/dependencies/js/jquery.min.js"></script>
<script src="<?=base_url?>assets/dependencies/js/bootstrap.min.js"></script>

	<!-- Materialize CSS CDN -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->

<script>



</script>



	<div id = "container">
	<?php if(isset($_SESSION['identity'])){  ?>
	<header id = "header">
		<div id = "logo">
			<img src="<?=base_url?>assets/image/caja2.png"/>
			
			<div style="display: flex;justify-content: space-between;">
			<a href="#" id="logo_a">
				l-Picking
			</a>

			<!-- <a>Salir</a> -->
		</div>

		<?php if(isset($_SESSION['identity'])){  ?>
		<div style="display: flex;justify-content: end;">
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $_SESSION['identity']['nombre_usuario']?>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#">Detalle</a>
				<a class="dropdown-item" href="<?=base_url?>reportes/miPage">About</a>
				<a class="dropdown-item" href="<?=base_url?>usuario/salir">Salir</a>
			</div>
			</div>
		</div>

		<?php } ?>
	</div>
  			
	</header>


  
	<!--MENU-->
	
		<nav id = "menu">
			<ul>
				<li>
					<a href="<?=base_url?>">
						INICIO
					</a>
				</li>
				<?php if(isset($_SESSION['identity']) && $_SESSION['identity']['tipo_usuario'] == 'USER' ){  ?>
                  <li>
					<a href="<?=base_url?>picking/index2">
          				REGISTRO
  					</a>
				</li>	
				<li>
					<a href="<?=base_url?>factura/index">
          				REG. FACTURA MTY
  					</a>
				</li>	

				<li>
					<a href="<?=base_url?>picking/existencias">
						EXISTENCIAS
  					</a>
				</li>	

				<?php } ?>

				<?php if(isset($_SESSION['identity']) && $_SESSION['identity']['tipo_usuario'] == 'ADMIN' ){  ?>
                  <li>
					<a href="<?=base_url?>picking/index2">
          				REGISTRO
  					</a>
				</li>	

				<?php } ?>


				<?php if((isset($_SESSION['identity']) && $_SESSION['identity']['tipo_usuario'] == 'REPORT')|| (isset($_SESSION['identity']) && $_SESSION['identity']['tipo_usuario'] == 'ADMIN') ){  ?>
					<li>
					<!-- <a href="<?=base_url?>reportes/index">
          				REPORTES
  					</a> -->
					  <div class="dropdown">
						<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							REPORTES-PICKING
						</button>
						<div class="dropdown-menu" style="background: #37446e;" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>reportes/Lpicking">Picking</a>
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>reportes/mini_catalogo">Mini Catalogo</a>
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>picking/reporte">Todos-Registros</a>
						</div>
						</div>
				</li>

				<li>
					<!-- <a href="<?=base_url?>reportes/index">
          				REPORTES
  					</a> -->
					  <div class="dropdown">
						<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							REPORTES-ESPECIALES
						</button>
						<div class="dropdown-menu" style="background: #37446e;" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>reportes/lineaVenta">Lineas Venta</a>
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>reportes/mini_catalogo">Coming soon..</a>
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>picking/reporte">Coming soon..</a>
						</div>
						</div>
				</li>

				<?php } ?>

				<!-- <li>
					<a href="<?=base_url?>picking/reporte">
          				REPORTE
  					</a>
				</li> -->
				<?php if(isset($_SESSION['identity']) && $_SESSION['identity']['tipo_usuario'] == 'ADMIN' ){  ?>
				<li>
					<a href="<?=base_url?>usuario/registro">
          				REGISTRO USUARIOS
  					</a>
				</li>

				<li>
					<a href="<?=base_url?>reportes/chart">
          				CHARTS
  					</a>
				</li>

				<li>
					<a href="<?=base_url?>reportes/miPage">
          				Mi Pagina
  					</a>
				</li>
<!-- <a href="<?=base_url?>reportes/index">
          				REPORTES
  					</a> -->
				<!-- <li>
					
					  <div class="dropdown">
						<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							REPORTES
						</button>
						<div class="dropdown-menu" style="background: #37446e;" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>reportes/Lpicking">Picking</a>
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>reportes/mini_catalogo">Mini Catalogo</a>
							<a class="dropdown-item" id = "reporte" href="<?=base_url?>picking/reporte">Todos-Registros</a>
						</div>
						</div>
				</li> -->
				
				<?php }  ?>
             
               							
			</ul>
			
		</nav>

		<?php } ?>

			<div id = "content">

			<?php } ?>