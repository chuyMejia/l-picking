<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Picking</title>
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
    <h2>Reporte Lineas Venta</h2>
    <div style="padding: 2%;">
    <table id="tabla_reporte" class="display">
        <thead>
            <tr>
                <th >Item</th>
                <th>Descripcion</th>
                <th>Marca</th>
                <th>Factura</th>
                <th>INVOICEDATE</th>
                <th>Cliente</th>
                <th>Venta</th>
                <th>VentasQty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $row): ?>
                <tr>
                    <td><?php echo $row['Item']; ?></td>
                    <td><?php echo $row['Descripcion']; ?></td>
                    <td><?php echo $row['Marca']; ?></td>
                    <td><?php echo $row['Factura']; ?></td>
                    <td><?php echo $row['INVOICEDATE']->format('Y-m-d'); ?></td>
                    <td><?php echo $row['Cliente']; ?></td>
                    <td><?php echo $row['Venta']; ?></td>
                    <td><?php echo $row['VentasQty']; ?></td>
                   
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
            'excelHtml5','print' // Botón de exportar a Excel
           // 'pdfHtml5' // Botón de exportar a PDF
        ]
    });
});

    </script>
</body>
</html>
