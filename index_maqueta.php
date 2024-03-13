<?php


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Tienda de camisetas online</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<meta charset="utf-8">
</head>
<body>
	<div id = "container">

	<!--CABECERA-->
	<header id = "header">
		<div id = "logo">
			<img src="assets/image/camisetas.png"/>
			<a href="#">
				Tienda de camisetas
			</a>
			
		</div>

	</header>

	<!--MENU-->
		<nav id = "menu">
			<ul>
				<li>
					<a href="#">
						INICIO
					</a>
				</li>
                <li>
					<a href="#">
						CATEGORIA 1 
					</a>
				</li>
                <li>
					<a href="#">
						CATEGORIA 2
					</a>
				</li>
                <li>
					<a href="#">
          				CATEGORIA3
  					</a>
				</li>
                <li>
					<a href="#">
          				CATEGORIA4
  					</a>
				</li>								
			</ul>
			
		</nav>

			<div id = "content">
			    <!--BARRA LATERAL-->
			    <aside id = "lateral">
			    	<div id = "login" class="block_aside">
			    		<h3>Entrar a la web </h3>
			    		<form action="#" method="post">
				    		<label for="email">Email</label>
				    		<input type="email" name="email"/>
				    		<label for="password">Password</label>
				    		<input type="password" name="password"/>
				    		<input type="submit" name="enviar" value="ENVIAR">
                        </form>
                        <ul>
                        	<li>
				    		<a href="#">Mis pedidos</a>
				    		</li>
				    		<li>
				    		<a href="#">Gestionar pedidos</a>
				    		</li>
				    		<li>
				    		<a href="#">Gestionar categorias</a>
			    	    	</li>
			    		</ul>
			    	</div>
			    </aside>

			    <div id = "central">
			    	<!--CONTENIDO CENTRA-->
			    	<h1>Productos Destacados</h1>
			    <div class="product">

			    	<img src="assets/image/camisetas.png"/>
			    	<h2>Camiseta Azul Ancha</h2>
			    	<p>300 pesos</p>
			    	<a href="#" class="button">Comprar</a>

			    </div>
					 <div class="product">

			    	<img src="assets/image/camisetas.png"/>
			    	<h2>Camiseta Azul Ancha</h2>
			    	<p>300 pesos</p>
			    	<a href="#" class="button">Comprar</a>

			    </div>
				 <div class="product">

			    	<img src="assets/image/camisetas.png"/>
			    	<h2>Camiseta Azul Ancha</h2>
			    	<p>300 pesos</p>
			    	<a href="#" class="button">Comprar</a>

			    </div>
			</div>

			</div>

	<!--PIE DE PAGINA-->
	<!-- <footer id = "footer">Desarrollado ppor chuy &copy; <?= date("Y");?></footer> -->

	</div>

	


</body>
</html>