<?php

class Picking {
    private $id;
    private $item;
    private $descripcion;
    private $cantidad;
    private $isCorrect;
    private $del;
    private $al;
    private $choice;
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    function getId() {
		return $this->id;
	}
    function getDescripcion() {
		return $this->descripcion;
	}

    function getCantidad() {
		return $this->cantidad;
	}
    function getItem() {
		return $this->item;
	}

    

    function getIsCorrect() {
		return $this->isCorrect;
	}

    function getDel() {
		return $this->del;
	}

    function getAl() {
		return $this->al;
	}

    function getChoice() {
		return $this->choice;
	}

    
	function setChoice($choice) {
		$this->choice = $choice;
	}



	function setId($id) {
		$this->id = $id;
	}
    function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

    function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}
    function setItem($item) {
		$this->item = $item;
	}

    function setIsCorrect($isCorrect) {
		$this->isCorrect = $isCorrect;
	}

    function setDel($del) {
		$this->del = $del;
	}


    function setAl($al) {
		$this->al = $al;
	}


public function buscar_detail(){

    

     

    $del_ = $this->del;
    $hasta_ = $this->al;
    $opcion_ = $this->choice;

        
    // $docuNum = 'RPI1462043';
    $sql = "  SELECT Q1.COMPLETOS,Q2.INCOMPLETOS FROM (
        SELECT COUNT(*) AS COMPLETOS,'X' AS LLAVE
        FROM check_picking
        WHERE IS_CORRECT = 1
        AND rpi_picking NOT IN (
            SELECT rpi_picking
            FROM check_picking
            WHERE IS_CORRECT = 0
            GROUP BY rpi_picking)
        AND  fecha_registro between '2024-03-05' and '2024-03-12'	) AS Q1	
        LEFT JOIN (
        
         SELECT COUNT(rpi_picking) AS INCOMPLETOS,'X' AS LLAVE 
            FROM check_picking
            WHERE IS_CORRECT = 0
            AND  fecha_registro between '2024-03-05' and '2024-03-12'
          
        
        )AS Q2 ON Q1.LLAVE = Q2.LLAVE ";



   
   // $sql = 'SELECT  * FROM check_picking;';

    // Ejecuta la consulta usando la conexión existente
    $result = sqlsrv_query($this->db, $sql);

    // Verifica si la consulta fue exitosa
    if ($result === false) {
        // Manejar el error si la consulta falla
        throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
    }

    // Almacena los resultados en un array
    $rows = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $rows[] = $row;
    }

    // Cierra la conexión
    sqlsrv_close($this->db);

    // Retorna los resultados
    return $rows;

    
}


    public function exist() {

     

        $docuNum = $this->id;
        
        // $docuNum = 'RPI1462043';
        $sql = "	SELECT TOP 1 rpi_picking FROM check_picking WHERE RPI_PICKING = '".$docuNum."'";

       
       // $sql = 'SELECT  * FROM check_picking;';
    
        // Ejecuta la consulta usando la conexión existente
        $result = sqlsrv_query($this->db, $sql);
    
        // Verifica si la consulta fue exitosa
        if ($result === false) {
            // Manejar el error si la consulta falla
            throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
        }
    
        // Almacena los resultados en un array
        $rows = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }
    
        // Cierra la conexión
        sqlsrv_close($this->db);
    
        // Retorna los resultados
        return $rows;
        

    }

 
    public function check() {

        $docuNum = $this->id;
        // $docuNum = 'RPI1462043';
        $queryCompleja = "SELECT CAST(T1.QTY AS DECIMAL(5,0)) AS 'Cant',
                                T1.ITEMID AS 'Clave',
                                SUBSTRING(T2.Name,1,40) AS 'Descrip'
                        FROM MicrosoftDynamicsAX.dbo.WMSPICKINGROUTE T0 
                        INNER JOIN MicrosoftDynamicsAX.dbo.WMSORDERTRANS T1 ON T0.PICKINGROUTEID = T1.ROUTEID
                        INNER JOIN MicrosoftDynamicsAX.dbo.TRV_Item T2 ON T2.ITEMID = T1.ITEMID
                            WHERE T0.PICKINGROUTEID = ?";

        $params = array($docuNum);
        $resultComplejo = sqlsrv_query($this->db, $queryCompleja, $params);

        if ($resultComplejo === false) {
            throw new Exception("Error en la consulta compleja: " . print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($resultComplejo, SQLSRV_FETCH_ASSOC)) {
            // Realizar operaciones con cada fila de resultados
            print_r($row);
        }

        // Cerrar la conexión cuando hayas terminado
        Database::cerrarConexion();

        return $resultComplejo;
    }

    public function getAll() {
        // Consulta SQL
        $sql = 'SELECT  * FROM check_picking;';
    
        // Ejecuta la consulta usando la conexión existente
        $result = sqlsrv_query($this->db, $sql);
    
        // Verifica si la consulta fue exitosa
        if ($result === false) {
            // Manejar el error si la consulta falla
            throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
        }
    
        // Almacena los resultados en un array
        $rows = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }
    
        // Cierra la conexión
        sqlsrv_close($this->db);
    
        // Retorna los resultados
        return $rows;
    }


    public function getchart() {
        // Consulta SQL
        $sql = "
        SELECT COUNT(*) AS 'registros', 'incompletos' as 'tipo'
        FROM (
            SELECT rpi_picking
            FROM check_picking
            WHERE IS_CORRECT = 0
            GROUP BY rpi_picking
        ) AS Subquery
        
        UNION
        
        SELECT COUNT(*) AS 'registros', 'completos' as 'tipo'
        FROM (
            SELECT rpi_picking
            FROM check_picking
            WHERE IS_CORRECT = 1
            AND rpi_picking NOT IN (
                SELECT rpi_picking
                FROM check_picking
                WHERE IS_CORRECT = 0
                GROUP BY rpi_picking
            )
            GROUP BY rpi_picking
        ) AS Subquery;
    ";
    
    
        // Ejecuta la consulta usando la conexión existente
        $result = sqlsrv_query($this->db, $sql);
        
    
        // Verifica si la consulta fue exitosa
        if ($result === false) {
            // Manejar el error si la consulta falla
            throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
        }
    
        // Almacena los resultados en un array
        $rows = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }
    
        // Cierra la conexión
        sqlsrv_close($this->db);
    
        // Retorna los resultados
        return $rows;
    }




    
    public function getchart_Semana() {
        // Consulta SQL
        $sql = "
        select * from (
        --lunes
        SELECT COUNT(*) AS 'registros', 'incompletos' as 'tipo',(SELECT DATEADD(DAY, 2 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'LUN' AS  DAY_,'1' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 0
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 2 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    GROUP BY rpi_picking
                ) AS Subquery
                UNION 
                SELECT COUNT(*) AS 'registros', 'completos' as 'tipo',(SELECT DATEADD(DAY, 2 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'LUN' AS  DAY_,'1' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 1
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 2 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    AND rpi_picking NOT IN (
                        SELECT rpi_picking
                        FROM check_picking
                        WHERE IS_CORRECT = 0
                        GROUP BY rpi_picking
                    )
                    GROUP BY rpi_picking
                ) AS Subquery
        union
        
        ---martes
        SELECT COUNT(*) AS 'registros', 'incompletos' as 'tipo',(SELECT DATEADD(DAY, 3 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'MAR' AS  DAY_,'2' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 0
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 3 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    GROUP BY rpi_picking
                ) AS Subquery
                UNION 
                SELECT COUNT(*) AS 'registros', 'completos' as 'tipo',(SELECT DATEADD(DAY, 3 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'MAR' AS  DAY_,'2' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 1
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 3 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    AND rpi_picking NOT IN (
                        SELECT rpi_picking
                        FROM check_picking
                        WHERE IS_CORRECT = 0
                        GROUP BY rpi_picking
                    )
                    GROUP BY rpi_picking
                ) AS Subquery
        union
        
        ---------------------query bien por dia miercoles 
         SELECT COUNT(*) AS 'registros', 'incompletos' as 'tipo',(SELECT DATEADD(DAY, 4 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'MIER' AS  DAY_,'3' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 0
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 4 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    GROUP BY rpi_picking
                ) AS Subquery
                UNION 
                SELECT COUNT(*) AS 'registros', 'completos' as 'tipo',(SELECT DATEADD(DAY, 4 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'MIER' AS  DAY_,'3' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 1
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 4 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    AND rpi_picking NOT IN (
                        SELECT rpi_picking
                        FROM check_picking
                        WHERE IS_CORRECT = 0
                        GROUP BY rpi_picking
                    )
                    GROUP BY rpi_picking
                ) AS Subquery
        union
        -----jueves
         SELECT COUNT(*) AS 'registros', 'incompletos' as 'tipo',(SELECT DATEADD(DAY, 5 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'JUE' AS  DAY_,'4' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 0
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 5 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    GROUP BY rpi_picking
                ) AS Subquery
                UNION 
                SELECT COUNT(*) AS 'registros', 'completos' as 'tipo',(SELECT DATEADD(DAY,5 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'JUE' AS  DAY_,'4' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 1
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 5 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    AND rpi_picking NOT IN (
                        SELECT rpi_picking
                        FROM check_picking
                        WHERE IS_CORRECT = 0
                        GROUP BY rpi_picking
                    )
                    GROUP BY rpi_picking
                ) AS Subquery
        union 
        --viernes 
        SELECT COUNT(*) AS 'registros', 'incompletos' as 'tipo',(SELECT DATEADD(DAY, 6 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'VIR' AS  DAY_,'5' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 0
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 6 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    GROUP BY rpi_picking
                ) AS Subquery
                UNION 
                SELECT COUNT(*) AS 'registros', 'completos' as 'tipo',(SELECT DATEADD(DAY,6 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)) )AS DAY,'VIR' AS  DAY_,'5' as num_dia
                FROM (
                    SELECT rpi_picking
                    FROM check_picking
                    WHERE IS_CORRECT = 1
                    AND FECHA_REGISTRO = (SELECT DATEADD(DAY, 6 - DATEPART(WEEKDAY, GETDATE()), CAST(GETDATE() AS DATE)))
                    AND rpi_picking NOT IN (
                        SELECT rpi_picking
                        FROM check_picking
                        WHERE IS_CORRECT = 0
                        GROUP BY rpi_picking
                    )
                    GROUP BY rpi_picking
                ) AS Subquery)AS Semana
                order by 5;        
    ";
    
    
        // Ejecuta la consulta usando la conexión existente
        $result = sqlsrv_query($this->db, $sql);
        
    
        // Verifica si la consulta fue exitosa
        if ($result === false) {
            // Manejar el error si la consulta falla
            throw new Exception("Error en la consulta: " . print_r(sqlsrv_errors(), true));
        }
    
        // Almacena los resultados en un array
        $rows = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }
    
        // Cierra la conexión
        sqlsrv_close($this->db);
    
        // Retorna los resultados
        return $rows;
    }
    
    public function save(){
        $docuNum = $this->id; // RPI
        $item_ = $this->item;
        $cantidad_ = $this->cantidad;
        $iscorrect_ = $this->isCorrect;
    
        // Obtener la fecha actual
        $fechaActual = date("Y-m-d H:i:s");
    
        // Aquí debes establecer la variable $usuario con el usuario correspondiente
        // Puedes obtenerlo de la sesión, por ejemplo.
        $usuario = "usuario_ejemplo";
    
        try {
            // Inserción en la tabla check_picking
            $sql = "INSERT INTO check_picking (rpi_picking, item_id, cantidad, fecha_registro, usuario,is_Correct) 
                    VALUES (?, ?, ?, ?, ?,?)";

                 
            // Prepara la consulta
            $stmt = sqlsrv_prepare($this->db, $sql, array(&$docuNum, &$item_, &$cantidad_, &$fechaActual, &$usuario,&$iscorrect_));
    
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
    
    
    





}
