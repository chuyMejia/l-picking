

<?php if(isset($edit)){ ?>
<h1>Editar <?= $pro->nombre; ?> producto</h1>
<?php 

$action_url = base_url."producto/save&id=".$pro->id;

?>

<?php }  else{ ?>
<h1>Crear nuevo producto</h1>
<?php
$action_url = base_url."producto/save";

 }  ?>

<div class="form_midle">
<form action="<?=$action_url?>" method = "POST" enctype = "multipart/form-data">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" value="<?php if (isset($pro->nombre)){ echo $pro->nombre;}else{echo "";}?>"  >

	<label for="descripcion">Descripcion</label>
	<textarea  name="descripcion"><?php if (isset($pro->descripcion)){ echo $pro->descripcion;}else{echo "";}?> </textarea>

	<label for="precio">Precio</label>
	<input type="number" name="precio" value="<?php if (isset($pro->precio)){ echo $pro->precio;}else{echo "";}?>">

	<label for="stock">Stock</label>
	<input type="number" name="stock" value="<?php if (isset($pro->stock)){ echo $pro->stock;}else{echo "";}?>">
    <?php  $categorias =  Utils::showAllCategorias();?>
	<label for="categoria">Categoria</label>
	<select name = 'categoria'>
     <?php while ( $cat = $categorias->fetch_object() ){?>

		<option value = '<?=$cat->id?>' <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '';  ?>>
			<?=$cat->nombre?>
		</option>
	<?php }?>
	</select>

	<label for="image">Imagen</label>
	<?php if(isset($pro) && is_object($pro) && !empty($pro->image)){  ?>

    <img src="<?= base_url?>uploads/images/<?=$pro->image?>" class = "thumb"/>

   <?php	} ?>
	<input type="file" name="imagen">
	<input type="submit" value="Guardar">
	

</form>
</div>



<?php
?>