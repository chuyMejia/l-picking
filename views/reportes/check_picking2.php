<!DOCTYPE html>





<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Picking</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> -->

    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>


    
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Reporte de Picking </h2>
    <div style="padding: 2%;">
    <table id="tabla_reporte" class="display">
        <thead>
            <tr>
                <th >RPI_PICKING</th>
                <th>Fecha de Picking</th>
                <th>Usuario de Registro</th>
                <th>Nombre de Registro</th>
                <th>Empleado de Picking</th>
                <th>Orden de Venta</th>
                <th>Picker</th>
                <th>ESTATUS</th>
                <th>Paqueteria</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><a href="<?=base_url?>reportes/detalle&RPI=<?=$row['RPI_PICKING']?>"><?php echo $row['RPI_PICKING']; ?></a></td>
                    <td><?php echo $row['Fecha_LPicking']; ?></td>
                    <td><?php echo $row['USUARIO_REGISTRO']; ?></td>
                    <td><?php echo $row['NOMBRE_REGISTRO']; ?></td>
                    <td><?php echo $row['EMP_PICKING']; ?></td>
                    <td><?php echo $row['ordenVenta']; ?></td>
                    <td><?php echo $row['PICKER']; ?></td>
                    <td><?php echo $row['ESTATUS']; ?></td>
                    <td><?php echo $row['PACK']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
            </div>

    <script>
      $(document).ready(function() {
    $('#tabla_reporte').DataTable({
        dom: 'Bfrtip', // Agrega el contenedor para los botones
        buttons: [
           // 'copy', // Botón de copiar
            'excelHtml5', // Botón de exportar a Excel
           // 'pdfHtml5' // Botón de exportar a PDF
        ]
    });
});

    </script>
</body>
</html>
