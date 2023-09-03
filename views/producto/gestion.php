
<h1>Gestion de productos</h1>


<a href="<?=base_url?>producto/crear" class = "button button-small">CREAR PRODUCTO</a>

<?php if(isset($_SESSION['PRODUCTO']) && isset($_SESSION['PRODUCTO']) == 'complete'){?>
	<strong class="alert_green">REGIATRO INSERTADO CORRECTAMENTE</strong>
   <?php } elseif(isset($_SESSION['PRODUCTO']) && isset($_SESSION['PRODUCTO']) == 'failed'){  echo $_SESSION['PRODUCTO'];  die();?>
    <strong class="alert_red">REGIATRO NO INSERTADO CORRECTAMENTE</strong>
<?php }  Utils::deleteSession('PRODUCTO'); ?>

<?php if(isset($_SESSION['delete']) && isset($_SESSION['delete']) == 'complete'){?>
	<strong class="alert_green">REGIATRO INSERTADO CORRECTAMENTE</strong>
   <?php } elseif(isset($_SESSION['delete']) && isset($_SESSION['delete']) == 'failed'){  echo $_SESSION['delete'];  die();?>
    <strong class="alert_red">REGIATRO NO INSERTADO CORRECTAMENTE</strong>
<?php }  Utils::deleteSession('delete'); ?>

<table>
	<tbody>
     <tr>
     	<th>id</th>
     	<th>nombre</th>
     	<th>descripcion</th>
     	<th>precio</th>
     	<th>stock</th>
     	<th>Aciones</th>
     </tr> 
<?php
//var_dump($categorias);
while($prod = $productos->fetch_object()){
        echo "<tr>";
        echo "<td>";
		echo $prod->id;
		echo "</td>";
		echo "<td>";
		echo $prod->nombre;
		echo "</td>";
        echo "<td>";
		echo $prod->descripcion;
		echo "</td>";
		echo "<td>";
		echo $prod->precio;
		echo "</td>";
        echo "<td>";
		echo $prod->stock;
		echo "</td>";
		?>
		<td>
			<a href="<?=base_url?>producto/edit&id=<?=$prod->id?>" class="button button-gestion">Editar</a>
			<a href="<?=base_url?>producto/delete&id=<?=$prod->id?>" class="button button-gestion button-warning">Eliminar</a>
		</td>
		
		<?php	//elinar con puro php

		echo "</tr>";
}
?>
</tbody>
</table>