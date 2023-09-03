<!--CONTENIDO CENTRA-->
<h1>Productos Destacados</h1>

<?php  while ($product = $productos->fetch_object()):  ?>

	<div class="product">
                    <?php if($product->image !=  NULL ) : ?>
                    <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			    	<img src="<?=base_url?>uploads/images/<?=$product->image?>"/>
			    	<?php else:   ?>
			    	 <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			    		<img src="assets/image/camisetas.png"/>

			    <?php endif; ?>
			    	<h2><?= $product->nombre ?></h2>
			    	<p><?=$product->precio?> Pesos</p>
                    </a>
			    	<a href="#" class="button">Comprar</a>

			    </div>


<?php endwhile; ?>
			  

			
			