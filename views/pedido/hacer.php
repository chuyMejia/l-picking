
<h1>Hacer  pedido </h1>



<?php if(isset($_SESSION['identity'])): ?>

<p>
	<a href="<?=base_url?>carrito/index">Ver productos del carrito</a>
</p>
<br>

<h3>Direccion para el enviio</h3>

<form action="<?=base_url?>pedido/add" method="POST" >

	<label for="localidad">Localidad</label>
	<input type="text" name="localidad" required="">
	<label for="provincia">Provincia</label>
	<input type="text" name="provincia" required="">
	<label for="direccion">Dirección</label>
	<input type="text" name="direccion" required="">

	<input type="submit" name="">
	

</form>




<?php else: ?>

	<h2>indentificate por favor para poder continuar</h2>

<?php endif; ?>






