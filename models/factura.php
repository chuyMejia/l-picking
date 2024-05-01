<?php

class Factura {

    private $id;
    private $factura;
    private $user;
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

   

    function getId() {
		return $this->id;
	}
    function getFactura() {
		return $this->factura;
	} 
    function getUser() {
		return $this->user;
	}


    
	function setId($id) {
		$this->id = $id;
	}
    function setFactura($factura) {
		$this->factura = $factura;
	}

    function setUser($user) {
		$this->user = $user;
	}


//////////funcion para registrar facturas


public function save2(){


    $fac = $this->factura;
    $usuario = $this->user;


    

    try {
        // Inserción en la tabla check_picking



      //  $sql = "INSERT INTO check_picking (rpi_picking, item_id, cantidad, fecha_registro, usuario, is_Correct) 
          //      VALUES (?, ?, ?, GETDATE(), ?, ?)";

        $sql = "INSERT INTO trv_Facturas_foraneas (Factura, Usuario, Fecha) 
        VALUES ('$fac', $usuario, GETDATE());";
             
        // Prepara la consulta
        $stmt = sqlsrv_prepare($this->db, $sql);

        //$stmt = sqlsrv_prepare($this->db, $sql, array(&$docuNum, &$item_, &$cantidad_, &$usuario,&$iscorrect_));

        // Ejecutar la consulta
        if (sqlsrv_execute($stmt)) {
            // Verificar el resultado
            echo json_encode(['message' => 'Datos insertados en la tabla check_picking']);
            
        } else {
            // Manejar cualquier error en la ejecución
            echo json_encode(['error' => 'Error al insertar datos en la tabla check_picking: ' . print_r(sqlsrv_errors(), true)]);
        }
       // die();
    } catch (Exception $e) {
        // Manejar cualquier excepción
        echo json_encode(['error' => 'Error al insertar datos en la tabla check_picking: ' . $e->getMessage()]);
    }

      

  

}
public function save4() {
    $id = $this->id;
    $fac = $this->factura;
    $usuario = $this->user;

    $procedureName = "SPI_FACT_FORANEA";

    $sql = "EXEC $procedureName
            @Factura = '$fac',
            @Usuario = $usuario,
            @Opcion = $id";

    $stmt = sqlsrv_prepare($this->db, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Verificar si hay resultados
    if (sqlsrv_has_rows($stmt)) {
        // Recorrer los resultados y almacenarlos en un arreglo
        $resultados = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $resultados[] = $row;
        }

        // Cerrar el statement
        sqlsrv_free_stmt($stmt);

        // Devolver los resultados
        return $resultados[0];
    } else {
        // No hay resultados disponibles
        echo "No hay resultados disponibles.";
    }
}


public function save5() {
    $id = $this->id;
    $fac = $this->factura;
    $usuario = $this->user;

    $procedureName = "SPI_FACT_FORANEA";

    $sql = "EXEC $procedureName
            @Factura = '$fac',
            @Usuario = $usuario,
            @Opcion = $id";

    $stmt = sqlsrv_prepare($this->db, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Verificar si hay resultados
    if (sqlsrv_has_rows($stmt)) {
        // Recorrer los resultados y almacenarlos en un arreglo
        $resultados = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $resultados[] = $row;
        }

        // Cerrar el statement
        sqlsrv_free_stmt($stmt);

        // Devolver los resultados
        return $resultados[0];
    } else {
        // No hay resultados disponibles
        echo "No hay resultados disponibles.";
    }
}

public function save() {
    $id = $this->id;
    $fac = $this->factura;
    $usuario = $this->user;

    // Consulta de conteo para verificar si la factura ya existe
    $countQuery = "SELECT COUNT(*) AS cantidad FROM trv_Facturas_foraneas WHERE Factura = ?;";
    $stmtCount = sqlsrv_prepare($this->db, $countQuery, array($fac));
    if (!sqlsrv_execute($stmtCount)) {
        throw new Exception("Error al ejecutar la consulta de conteo: " . print_r(sqlsrv_errors(), true));
    }
    $row = sqlsrv_fetch_array($stmtCount, SQLSRV_FETCH_ASSOC);
    $cantidad = $row['cantidad'];

    // Si la factura ya existe, detener la ejecución y devolver el resultado
    if ($cantidad > 0) {
        return array('existe' => true);
    }

    // Consulta de validación de DLVMODE
    $queryValidacion = "SELECT TOP 1 COUNT(Q1.DLVMODE) AS cuenta
                        FROM MicrosoftDynamicsAX.dbo.CustInvoiceJour Q1
                        LEFT JOIN MicrosoftDynamicsAX.dbo.CustTable Q2 ON (Q1.ORDERACCOUNT = Q2.ACCOUNTNUM)
                        LEFT JOIN MicrosoftDynamicsAX.dbo.DirPartyTable Q3 ON (Q2.PARTY = Q3.RECID)
                        WHERE InvoiceId = ?
                        AND (Q1.DLVMODE = 29 OR Q1.DLVMODE = 30)";
    $stmtValidacion = sqlsrv_prepare($this->db, $queryValidacion, array($fac));
    if (!sqlsrv_execute($stmtValidacion)) {
        throw new Exception("Error al ejecutar la consulta de validación de DLVMODE: " . print_r(sqlsrv_errors(), true));
    }
    $rowValidacion = sqlsrv_fetch_array($stmtValidacion, SQLSRV_FETCH_ASSOC);
    $cuenta = $rowValidacion['cuenta'];

    // Si el valor de DLVMODE no es 29 o 30, detener la ejecución y devolver el resultado
    if ($cuenta === 0) {
        return array('existe' => 'no es 29 o 30');
    }

    // Consulta de inserción
    $insertQuery = "INSERT INTO trv_Facturas_foraneas (Factura, Usuario, Fecha) 
                    VALUES (?, ?, GETDATE());";
    $stmtInsert = sqlsrv_prepare($this->db, $insertQuery, array($fac, $usuario));
    if (!sqlsrv_execute($stmtInsert)) {
        throw new Exception("Error al insertar la factura: " . print_r(sqlsrv_errors(), true));
    }

    // Consulta de selección
    $selectQuery = "SELECT TOP 1 InvoiceId, ORDERACCOUNT, Q3.NAME, Q1.DLVMODE,
					  CASE 
						WHEN Q1.DLVMODE = 30 THEN 'CROSSDOCK SALTILLO'
						WHEN Q1.DLVMODE = 29 THEN 'CROSSDOCK MTY'
						ELSE 'OTRO'
						END CROSSDOCK
                    FROM MicrosoftDynamicsAX.dbo.CustInvoiceJour Q1
                    LEFT JOIN MicrosoftDynamicsAX.dbo.CustTable Q2 ON (Q1.ORDERACCOUNT = Q2.ACCOUNTNUM)
                    LEFT JOIN MicrosoftDynamicsAX.dbo.DirPartyTable Q3 ON (Q2.PARTY = Q3.RECID)
                    WHERE InvoiceId = ?;";
    $stmtSelect = sqlsrv_prepare($this->db, $selectQuery, array($fac));
    if (!sqlsrv_execute($stmtSelect)) {
        throw new Exception("Error al ejecutar la consulta de selección: " . print_r(sqlsrv_errors(), true));
    }

    // Almacenar los resultados en un array
    $rows = array();
    while ($row = sqlsrv_fetch_array($stmtSelect, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }

    // Cerrar los statements
    sqlsrv_free_stmt($stmtCount);
    sqlsrv_free_stmt($stmtValidacion);
    sqlsrv_free_stmt($stmtInsert);
    sqlsrv_free_stmt($stmtSelect);

    // Retorna los resultados
    return $rows;
}


///fq1499110
  


public function save3() {
    $id = $this->id;
    $fac = $this->factura;
    $usuario = $this->user;

    $procedureName = "SPI_FACT_FORANEA";

    $sql = "EXEC $procedureName
            @Factura = '$fac',
            @Usuario = $usuario,
            @Opcion = $id";

    $stmt = sqlsrv_prepare($this->db, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Recorrer los resultados (si los hay)
    $resultados = array();

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $resultados[] = $row;
    }

    // Cerrar el statement
    sqlsrv_free_stmt($stmt);

    // Crear un nuevo arreglo manualmente y agregar los valores necesarios
    $nuevoArreglo = array(
        'ORDERACCOUNT' => $resultados[0]['ORDERACCOUNT'],
        'InvoiceId' => $resultados[0]['InvoiceId'],
        'DLVMODE' => $resultados[0]['DLVMODE'],
        'NAME' => $resultados[0]['NAME']

    );

    // Devolver el nuevo arreglo
    return $nuevoArreglo;
}

public function  principal(){
   
    // Consulta de selección
    $selectQuery = "SELECT 
                            TOP 10 Q1.Factura,
                            Q2.ORDERACCOUNT,
                            Q4.NAME,
                            Q2.DLVMODE,                      
					  CASE 
						WHEN Q2.DLVMODE = 30 THEN 'CROSSDOCK SALTILLO'
						WHEN Q2.DLVMODE = 29 THEN 'CROSSDOCK MTY'
						ELSE 'OTRO'
						END CROSSDOCK
                        FROM  trv_Facturas_foraneas  Q1
                            LEFT JOIN MicrosoftDynamicsAX.dbo.CustInvoiceJour Q2
                                ON (Q1.Factura = Q2.InvoiceId )
                            LEFT JOIN MicrosoftDynamicsAX.dbo.CustTable Q3
                                ON (Q2.ORDERACCOUNT = Q3.ACCOUNTNUM )
                            LEFT JOIN MicrosoftDynamicsAX.dbo.DirPartyTable Q4 
                                ON (Q3.PARTY = Q4.RECID)
                        ORDER BY Q1.ID DESC;";


    $stmtSelect = sqlsrv_prepare($this->db, $selectQuery);
    if (!sqlsrv_execute($stmtSelect)) {
        throw new Exception("Error al ejecutar la consulta de selección: " . print_r(sqlsrv_errors(), true));
    }

    // Almacenar los resultados en un array
    $rows = array();
    while ($row = sqlsrv_fetch_array($stmtSelect, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }

   
    sqlsrv_free_stmt($stmtSelect);

    // Retorna los resultados
    return $rows;



}
  



}
