<?php

class reporte {
    private $id;
    private $db;
    private $rpi;



    /////--------atributos de reporte por fechas


    private $de;
    private $hasta;
    private $opcion;


    public function __construct() {
        $this->db = Database::conectar();
    }



    function getId() {
		return $this->id;
	}
    function getDe() {
		return $this->de;
	}
    function getHasta() {
		return $this->hasta;
	}
    function getOpcion() {
		return $this->opcion;
	}


    //////////////////////
    function getRpi() {
		return $this->rpi;
	}
 

	function setId($id) {
		$this->id = $id;
	}


    function setDe($de) {
		$this->de = $de;
	}
    
    function setHasta($hasta) {
		$this->hasta = $hasta;
	}
    
    function setOpcion($opcion) {
		$this->opcion = $opcion;
	}

    function setRpi($rpi) {
		$this->rpi = $rpi;
	}
    
    



    
    public function chart_data() {
        $parametro = $this->id;

        //$parametro = '2';

        // Nombre del procedimiento almacenado
        $procedureName = "sps_chart_picking";

        // Parámetros del procedimiento almacenado
        $params = array(
            array(&$parametro, SQLSRV_PARAM_IN)  // Parámetro de entrada
        );
        
        // Ejecutar el procedimiento almacenado
        $sql = "EXEC $procedureName @Parametro=?";
        $stmt = sqlsrv_prepare($this->db, $sql, $params);
        //$stmt = sqlsrv_prepare($this->db, $sql, array(&$docuNum, &$item_, &$cantidad_, &$fechaActual, &$usuario,&$iscorrect_));
    
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

        //echo json_encode($resultados);
        //die();

       //////

        
        return $resultados;

    }






    
    public function chart_data_detail() {
        $parametro = $this->id;

        
        $RPI = $this->rpi;

        //$parametro = '2';


        $procedureName = "sps_chart_picking";


          // Ejecutar el procedimiento almacenado
          $sql = "EXEC $procedureName  @Parametro = '$parametro',
          @Rpi = '$RPI'";

        //   echo $sql;
        //   die();

       


     
     
        $stmt = sqlsrv_prepare($this->db, $sql);
        //$stmt = sqlsrv_prepare($this->db, $sql, array(&$docuNum, &$item_, &$cantidad_, &$fechaActual, &$usuario,&$iscorrect_));
    
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

        //echo json_encode($resultados);
        //die();

       //////

        
        return $resultados;

    }
    

    /////craer nuva funcio para el controller y crear nuevo procedimiento que acvepre opcion fecha de hasta y la opcion 


    public function report_fecha(){


        $parametro = $this->id;
        $de = $this->de;
        $hasta = $this->hasta;
        $opcion =$this->opcion;


        //echo $parametro;
        //die();

        //$parametro = '2';

        // Nombre del procedimiento almacenado
        $procedureName = "SPS_REPORT_PICKING";

        // Parámetros del procedimiento almacenado
        $params = array(
            array(&$parametro, SQLSRV_PARAM_IN)  // Parámetro de entrada
        );
        
        // Ejecutar el procedimiento almacenado
        $sql = "EXEC $procedureName  @FechaInicio = '$de',
        @FechaFin = '$hasta',
        @Opcion = $opcion,
        @Parametro = $parametro";

        // echo $sql;
        // die();



        $stmt = sqlsrv_prepare($this->db, $sql);
        //$stmt = sqlsrv_prepare($this->db, $sql, array(&$docuNum, &$item_, &$cantidad_, &$fechaActual, &$usuario,&$iscorrect_));
    
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

        //echo json_encode($resultados);
        //die();

       //////

        
        return $resultados;

        



   die();





    }

   



}
