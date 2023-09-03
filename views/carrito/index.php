

<h1>hola este es el carrito</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1  ):
 


?>
<table>
	<tbody>
		<tr>
			<td>imagen</td>
			<td>nombre</td>
			<td>Precio</td>
			<td>Unidades</td>
			<td>Accion</td>
		</tr>




<?php






	foreach ($carrito as $indice => $elemento) {



		echo "<tr>";
		echo "<td>";
		$producto = $carrito[$indice]['producto'];


	//echo	$carrito[$indice]['producto']->image;


	if($producto->image){//imagen
		?>
         <img src="<?=base_url?>uploads/images/<?=$producto->image?>"/ class = "img_carrito">
		<?php

	}else{?>

		<img src="<?=base_url?>assets/image/camisetas.png"/ class = "img_carrito">
<?php	}
    echo "</td>";
    echo "<td><a href= '".base_url."/producto/ver&id=".$producto->id."'>".$producto->nombre."</a></td>";//precio
    echo "<td>".$producto->precio."</td>";
   ?>

		<td>
			<a  href="<?=base_url?>/carrito/down&index=<?=$indice?> ">-</a>
			<?=$carrito[$indice]['unidades']?>
			<a   href="<?=base_url?>/carrito/up&index=<?=$indice?> ">+</a>	
		</td>

		<td> <a class = "button button-table" href="<?=base_url?>/carrito/delete&index=<?=$indice?> " class="button button-pedido">Borrar</a>	</td>
    <?php
   


	echo "</tr>";


	$stats = Utils::statsCarrito();

	echo "</br>";


/* if($carrito[$indice]['producto']->image !=  NULL ) : ?>
                   
			    	<img src="<?=base_url?>uploads/images/<?=$product->image?>"/>
			    	<?php else:   ?>
			    		<img src="<?=base_url?>assets/image/camisetas.png"/>
                    
			    <?php endif; ?>

<?php

	}

	*/
}?>

	</tbody>

</table>
</br>
</br>
<div >
	 <a class = "button button-delete" href="<?=base_url?>/carrito/delete_All" class="button button-pedido">Borrar todo</a>	
</div>

</br>

<strong>
   <h3>TOTAL : <?=$stats['total']?></h3>
   <a href="<?=base_url?>/pedido/index" class="button button-pedido">Treminar compra</a>
 </strong>

<?php else:   ?>
	<p>El carrito esta vacio favoe agrega productos</p>
<?php endif;?>	