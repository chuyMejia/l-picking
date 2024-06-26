

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

<div>
    <button id="chy" style="width: 60px;
    border-radius: 0.3rem;
    margin-top: 6px;
    margin-left: 6px;
    margin-bottom: 6px;">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z"/>
</svg>
</button>
</div>



<?php

echo '<div style="display: flex;
    margin: 17px;">
<table>
<tr>
    <th>ITEM</th>
    <th>EMPRESA</th>
    <th>ALMACEN</th>
    <th>LOCALIDAD</th>
    <th>INVENTARIO_FISICO</th>
    <th>FISICA_RESERVADA</th>
    <th>FISICA_DISPONIBLE</th>
    <th>TOTAL_DISPONIBLE</th>
</tr>';

foreach ($result as $row) {
    echo '<tr>
            <td>' . htmlspecialchars($row['itemid']) . '</td>
            <td>' . htmlspecialchars($row['EMPRESA']) . '</td>
            <td>' . htmlspecialchars($row['ALMACEN']) . '</td>
            <td>' . htmlspecialchars($row['LOCALIDAD']) . '</td>
            <td>' . htmlspecialchars($row['INVENTARIO_FISICO']) . '</td>
            <td>' . htmlspecialchars($row['FISICA_RESERVADA']) . '</td>
            <td>' . htmlspecialchars($row['FISICA_DISPONIBLE']) . '</td>
            <td>' . htmlspecialchars($row['TOTAL_DISPONIBLE']) . '</td>
         </tr>';
}

echo '</table>
</div>';
?>





<!-- <div>
<table>
<tr>
    <th>iTEM</th>
    <th>FISICA_DISPONIBLE</th>
    <th>i</th>
    <th>i</th>
    <th>i</th>
  </tr>
  <tr>
    <td><?=json_encode($result[0]['ITEMID'])?></td>
    <td><?=json_encode($result[0]['FISICA_DISPONIBLE'])?></td>
    <td>Flor</td>
    <td>Ella</td>
    <td>Juan</td>
  </tr>
</table>

</div>
 -->


<script>
    
    $('#chy').click(function(){

        window.location.href = 'http://10.1.1.25/lista-Picking/picking/existencias';
    })
    
</script>



    <svg id="barcode"></svg>

    <script>

     // alert('<?=$result[0]['itemid']?>');
        JsBarcode("#barcode", "<?=$result[0]['itemid']?>", {
            format: "CODE128",
            displayValue: true
        });
    </script>
