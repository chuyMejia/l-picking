<?php if(isset($gestion)):  ?>
<h1>Gestionar Pedidos</h1>
<?php else : ?>
<h1>Mis Pedidos</h1>
<?php endif;  ?>
<?php
/*
var_dump($pedidos->fetch_object());
die();
*/
?>

<table>
	<tbody>
		<tr>
			<td>N de Pedido</td>
            <td>Coste</td>
            <td>Fecha</td>
            <td>Estado</td>
		</tr>

 	   <?php while($pred  = $pedidos->fetch_object()): ?>
 	   	<tr>
 	   	<td><a href="<?=base_url?>/pedido/detalle&id=<?=$pred->id?>"><?=$pred->id?></a></td>
 	   	<td><?=$pred->coste?></td>
 	   	<td><?=$pred->fecha?></td>
 	   	<td><?=Utils::showStatus($pred->estado)?></td>
 	   	</tr>
	   <?php endwhile; ?>




</tbody>	




</table>

<?php   ?>

