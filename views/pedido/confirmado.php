<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete' ): ?>

<h1>pedido confirmado</h1>

<p>favor deposita aqui 646477446 </p>


<?php if(isset($pedido)):  ?>

<h3>Datos del pedido</h3>
</br>

Numero de pedido: #  <?=$pedido->id?>  </br>
Total a apagar:    <?=$pedido->coste?> $ </br>
Productos:	                            </br>




<?php endif; ?>
<?php else: ?>

<h1>Ocurrio un error favor intenta de nuevo</h1>
<?php endif; ?>
<table>
		<tbody>
		<tr>
			<td>imagen</td>
			<td>nombre</td>
			<td>Precio</td>
			<td>Unidades</td>
		</tr>
<?php /*  foreach ($productos->fetch_object() as $key => $productos) {
	echo $productos->nombre ;
	# code...
}*/
/*var_dump($productos->fetch_object()->nombre);
die();*/

while($producto = $productos->fetch_object()): ?>


<?php 


	echo "<tr>";
		echo "<td>";
	//	$producto = $carrito[$indice]['producto'];


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
    echo "<td>".$producto->unidades."</td>";
 
   


	echo "</tr>";





?>

<!----li><?= $producto->nombre?>  - <?= $producto->precio?></li------------->
    

<?php endwhile; ?>
</tbody>
</table>






