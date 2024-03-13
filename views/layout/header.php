
	<?php if(isset($_GET['TVR'])){

	}else{

	 ?>
	 <!DOCTYPE html>
<html lang="es">
<head>
	<title>l-Picking</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css">
	<meta charset="utf-8">
	<link href="<?=base_url?>assets/bootstrap-4.0.0/assets/css/docs.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url?>assets/bootstrap-4.0.0/dist/css/bootstrap.min.css">

	
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
	<script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>


	<!-- Materialize CSS CDN -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->

<script>

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
  });

  // Or with jQuery

  $('.dropdown-trigger').dropdown();


</script>



	<div id = "container">

	<header id = "header">
		<div id = "logo">
			<img src="<?=base_url?>assets/image/caja2.png"/>
			
			<div style="display: flex;justify-content: space-between;">
			<a href="#">
				l-Picking
			</a>

			<!-- <a>Salir</a> -->
	</div>
			
		</div>

	</header>

	<a class='dropdown-trigger btn' href='#' data-target='dropdown1'>Drop Me!</a>

<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
  <li><a href="#!">one</a></li>
  <li><a href="#!">two</a></li>
  <li class="divider" tabindex="-1"></li>
  <li><a href="#!">three</a></li>
  <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
  <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
</ul>
  
	<!--MENU-->
		<nav id = "menu">
			<ul>
				<li>
					<a href="<?=base_url?>">
						INICIO
					</a>
				</li>
              
                  <li>
					<a href="<?=base_url?>picking/index2">
          				REGISTRO
  					</a>
				</li>	

				<li>
					<a href="<?=base_url?>picking/reporte">
          				REPORTE
  					</a>
				</li>
				
				
             
               							
			</ul>
			
		</nav>

			<div id = "content">

			<?php } ?>