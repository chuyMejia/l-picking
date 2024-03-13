<!-- Incluir las bibliotecas y estilos de DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script>
	// Inicializar DataTables
	        $(document).ready(function() {
	            $('#miTabla').DataTable();
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