<h1>Detalle Pedido</h1>

<?php if(isset($pedido)):  ?>
  <?php if(isset($_SESSION['admin'])):  ?>
     <h3>Cambiar esstado de Pedido</h3>
     <form action="<?=base_url?>pedido/estado" method = "POST" >
       <input type="hidden" name="id_prod" value="<?=$pedido->id?>">	
       <select name="estado">
         <option value="CONFIRM" <?= $pedido->estado == 'CONFIRM' ? 'selected' :''?> >Pendiente</option>
         <option value="PREPARATING" <?= $pedido->estado == 'PREPARATING' ? 'selected' :''?>>En preparacion</option>
         <option value="READY" <?= $pedido->estado == 'READY' ? 'selected' :''?> >Preparandopara envio</option>
         <option value="SENDED" <?= $pedido->estado == 'SENDED' ? 'selected' :''?> >Enviado</option>       	
       </select>

       <input type="submit" value="Cambiar Estado">     	

     </form>
 </br>
 </br>



  <?php  endif;   ?>



	<h3>Direccion de envio</h3>
</br>

Localidad:    <?=$pedido->localidad?>  </br>
Provincia:    <?=$pedido->provincia?>  </br>
Direccion:    <?=$pedido->direccion?>  </br>
Estado:	      <?=Utils::showStatus($pedido->estado);?>                      </br>
Fecha Orden:	      <?=$pedido->fecha?>                      </br> </br>

<h3>Datos del pedido</h3>
</br>

Numero de pedido: #  <?=$pedido->id?>  </br>
Total a apagar:    <?=$pedido->coste?> $ </br>
Productos:	                            </br>




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






