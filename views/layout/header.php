<?php



?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Tienda de camisetas online</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css">
	<meta charset="utf-8">
</head>
<body>
	<div id = "container">

	<!--CABECERA-->
	<header id = "header">
		<div id = "logo">
			<img src="<?=base_url?>assets/image/camisetas.png"/>
			<a href="#">
				Tienda de camisetas
			</a>
			
		</div>

	</header>
      <?php $categorias =  Utils::showAllCategorias()?>
	<!--MENU-->
		<nav id = "menu">
			<ul>
				<li>
					<a href="<?=base_url?>">
						INICIO
					</a>
				</li>
               <?php while ($cat = $categorias->fetch_object()){ ?>
                  <li>
					<a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>">
          				<?php echo  $cat->nombre; ?>
  					</a>
				</li>	
               <?php }?>
               							
			</ul>
			
		</nav>

			<div id = "content">