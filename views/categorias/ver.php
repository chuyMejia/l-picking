
<?php if (isset($categoria)):?>
<h1><?= $categoria->nombre ?></h1>
 
 <?php if($productos->num_rows == 0): ?>
 	<p>	no hay productos disponibles para esta categoria</p>

 	<?php else : ?>
 		<?php  while ($product = $productos->fetch_object()):  ?>

	<div class="product">
                    <?php if($product->image !=  NULL ) : ?>
                    	<a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			    	<img src="<?=base_url?>uploads/images/<?=$product->image?>"/>
			    	<?php else:   ?>
			    		<a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			    		<img src="<?=base_url?>assets/image/camisetas.png"/>

			    <?php endif; ?>
			    	<h2><?= $product->nombre ?></h2>
			    </a>
			    	<p><?=$product->precio?> Pesos</p>
			    	
			    	<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>

			    </div>


		<?php endwhile; ?>


<?php endif;?>
<?php else: ?>
<h1>Categoria no existe</h1>
<?php endif; ?>