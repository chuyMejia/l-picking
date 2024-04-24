<!-- Incluir las bibliotecas y estilos de DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> -->

    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
<!-- 
<script>
	// Inicializar DataTables
	        $(document).ready(function() {
	            $('#miTabla').DataTable();
	        });
	
</script> -->


<script>
      $(document).ready(function() {
    $('#miTabla').DataTable({
        dom: 'Bfrtip', // Agrega el contenedor para los botones
        buttons: [
           // 'copy', // Botón de copiar
            'excelHtml5', // Botón de exportar a Excel
           // 'pdfHtml5' // Botón de exportar a PDF
        ]
    });
});

    </script>


<section style ="display: block;padding: 2%;">
    <?php
        // Tu código PHP para imprimir la tabla
        $datos = $show;

        //var_dump($datos);

        echo '<table id="miTabla" class="table" border="1">';
        echo '<thead class="thead-dark" ><tr>';
        // Imprimir encabezados de columna
        foreach ($datos[0] as $clave => $valor) {
            echo '<th scope="col">' . $clave . '</th>';
        }
        echo '</tr></thead>';

        // Imprimir filas de datos
        echo '<tbody>';
        foreach ($datos as $fila) {
            echo '<tr>';
            foreach ($fila as $valor) {
                // Formatear las fechas si es necesario
                if ($valor instanceof DateTime) {
                    $valor = $valor->format('Y-m-d H:i:s');
                }
                echo '<td>' . $valor . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
        ?>

</section>
</html>