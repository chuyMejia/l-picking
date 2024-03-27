

<!-- <h2>Detalle - <?=$_GET['RPI']?></h2> -->
<span class="badge badge-success" id ="detail_">Show Detalle</span>
<div class="card border-success mb-3" style="display:none;" style="max-width: 18rem;">
  <div class="card-header" style="color:#28a745;display: flex;justify-content: space-between;"> <span  class="badge badge-success detail_2"><?=$_GET['RPI']?></span> <span  class="badge badge-danger detail_2" >X</span></div>
  <div class="card-body text-success">
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Registro:</strong> <?=$detalle_user[0]['usuario']?>-<?=$detalle_user[0]['NOMBRE']?></li>
        <li class="list-group-item"><strong>Hora:</strong> <?=$detalle_user[0]['fecha_registro']->format('Y-m-d H:i:s')?></li>
        <li class="list-group-item"><strong>Pickeador:</strong> <?=$detalle_user[0]['codEmp']?> - <?=$detalle_user[0]['nombreComp']?></li>
    </ul>
  </div>
</div>


<div style ="display: flex;justify-content: space-between;">
<div class="card" style="width: 48%;">
<div class="card-body">
   

<?php
// Incluye tu código para obtener $data

// Verifica si $data no está vacío antes de generar la tabla
if (!empty($data)) {  ?>
    <table border="1">
    <tr>
        <th>Cantidad</th>
        <th>Clave</th>
        <th>Descripción</th>
        <th>Unidad</th>
        <th>Cliente</th>
    </tr>
    <?php
    // Itera sobre cada fila de datos en $data
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['Cant'] . '</td>';
        echo '<td>' . $row['Clave'] . '</td>';
        echo '<td>' . $row['Descrip'] . '</td>';
        echo '<td>' . $row['UNITID'] . '</td>';
        echo '<td>' . $row['CUSTOMER'] . '</td>';
        echo '</tr>';
    }
    ?>
   </table>
   </div>
</div>

<div class="card" style="width: 48%;">
  <div class="card-body">


<?php
// Incluye tu código para obtener $detalle

// Verifica si $detalle no está vacío antes de generar la tabla
if (!empty($detalle)) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Item ID</th><th>Cantidad</th><th>Fecha</th><th>Usuario</th><th>RPI Picking</th><th>Correcto</th></tr>';
    
    // Itera sobre cada fila de datos en $detalle
    foreach ($detalle as $row) {
        echo '<tr class="active_'.$row['is_Correct'].'">';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['item_id'] . '</td>';
        echo '<td>' . $row['cantidad'] . '</td>';
        echo '<td>' . $row['fecha_registro']->format('Y-m-d H:i:s') . '</td>';
        echo '<td>' . $row['usuario'] . '</td>';
        echo '<td>' . $row['rpi_picking'] . '</td>';
        echo '<td>' . ($row['is_Correct'] ? 'Sí' : 'No') . '</td>'; // Si is_Correct es 1, muestra 'Sí', de lo contrario 'No'
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'No se encontraron datos.';
}
?>

</div>
</div>

</div>



   <?php
} else {
    echo 'No se encontraron datos.';
}?>



<script>

$('#detail_').click(function(){

    console.log(this);
    $(this).hide();
    $('.border-success').show('slow');
    
});

$('.detail_2').click(function(){

    console.log(this);
    $('.border-success').hide('slow');
    $('#detail_').show('slow');

});

</script>