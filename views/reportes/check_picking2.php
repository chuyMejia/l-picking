<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Picking</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
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
    <h2>Reporte de Picking - <?=$result[0]['ESTATUS']?></h2>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
            </div>

    <script>
        $(document).ready(function() {
            $('#tabla_reporte').DataTable();
        });
    </script>
</body>
</html>
