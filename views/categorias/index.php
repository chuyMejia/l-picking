

<h1>GESTIONAR CATEGORIAS</h1>


<a href="<?=base_url?>categoria/crear" class = "button button-small">CREAR CATEGORIA</a>


<?php if(isset($_SESSION['cat_error'])):  ?>
       <p>Asegurate de borrar todos los productos de la categoria antes de borrar</p>

      <?php
     //  sleep(2);

       unset($_SESSION['cat_error']); 

       header( "refresh:4; url=".base_url."categoria/index" );
       
      // header('Location:'.base_url."categoria/index");


       ?> 	

<?php endif; ?>


<table>
	<tbody>
     <tr>
     	<th>id</th>
     	<th>nombre</th>
     	<th>action</th>
     </tr> 
<?php
//var_dump($categorias);
while($cat = $categorias->fetch_object()){
        echo "<tr>";
        echo "<td>";
		echo $cat->id;
		echo "</td>";
		echo "<td>";
		echo $cat->nombre;
		echo "</td>";

		?>
		<td>
         <a class = "button button-delete-categoria" href="<?=base_url?>/categoria/delete&elimina=<?=$cat->id?>" class="button button-pedido">Borrar</a>	
		</td>
		<?php	//elinar con puro php

		echo "</tr>";
}
?>
</tbody>
</table>

<script type="text/javascript">
	


	function chuy(param){
		alert(param);
		//hacer peticion ajax al controlador
	}
</script>