<?php


require_once 'models/reporte.php';

require_once 'models/picking.php';



class reportesController {

public function index(){

    require_once 'views/reportes/index.php';

}







public function chart(){

    /*$chart = new picking();
    $exec =  $chart->getchart();

    $chart2 = new picking();
    $exec_semana =  $chart2->getchart_Semana();*/

    $new_chart = new reporte();
    $new_chart->setId('2');
    $result = $new_chart->chart_data();
    $result = json_encode($result);


    //echo json_encode($result);

    //die();


    $new_chart_2 = new reporte();
    $new_chart_2->setId('1');
    $result_2 = $new_chart_2->chart_data();
    

   // var_dump($result_2[0]['COMPLETOS']);

  // var_dump($result_2[1]['COMPLETOS']);

    //die();


    $semana_ = new reporte();
    $semana_->setId('3');
    $exec_semana = $semana_->chart_data();

    //var_dump($exec_semana);
    //die();

    $mini_cat = new reporte();
    $mini_cat->setId('4');
    $exec_catalog = $mini_cat->chart_data();


   // var_dump($exec_catalog[0]['LUNES']);
    

   
   //require_once 'views/picking/chart.php';


//fq1474892  2223
  
    


   
    

   require_once 'views/reportes/chart.php';


	
}


public function Lpicking(){
//public function Lpicking(){


    require_once 'views/reportes/check_picking.php';

    
}


public function Lpicking2(){


      $de = $_POST['de'];
      $hasta = $_POST['hasta'];
      $opcion = $_POST['opcion'];


      $reporte =  new reporte();
      if($opcion == '4' || $opcion == 4){
        $reporte->setId('4');
      }else{
        $reporte->setId('1');
      }

     


      
     // $reporte->setId('1');//te da la opcion segn el procedure
      $reporte->setDe($de);
      $reporte->setHasta($hasta);
      $reporte->setOpcion($opcion);

      $result = $reporte->report_fecha();


    //   var_dump($result[0]['ESTATUS']);
    //   die();

      

      
     


    require_once 'views/reportes/check_picking2.php';


}


public function mini_catalogo(){
   

    require_once 'views/reportes/check_mini.php';
}


public function mini_catalogo2(){

    $de = $_POST['de'];
    $hasta = $_POST['hasta'];
    $opcion = $_POST['opcion'];


    $miniCat =  new reporte();
    $miniCat->setId('2');//te da la opcion segn el procedure
    $miniCat->setDe($de);
    $miniCat->setHasta($hasta);
    $miniCat->setOpcion($opcion);
    $result = $miniCat->report_fecha();

    //var_dump($result);


   

    require_once 'views/reportes/check_mini2.php';
}

public function detalle(){


   ////////CONTENIDO DEL DATO ORIGINAL
    $picking = new Picking();
    $picking->setId($_GET['RPI']);
    $data = $picking->rpi_data(); 
   // var_dump($data);

    /////////CONTENIDO DE DATOS GUARDADOS EN CHECK PIKING 
    $reporte = new reporte();
    $reporte->setId('5');
    $reporte->setRpi($_GET['RPI']);
    $detalle = $reporte->chart_data_detail();


   // var_dump($detalle);


   $user = new reporte();
   $user->setId('6');
   $user->setRpi($_GET['RPI']);


   $detalle_user = $user->chart_data_detail();

   //var_dump($detalle_user);

   //var_dump($detalle_user[0]['usuario']);
    




    require_once 'views/reportes/detalle.php';

}



    






}



?>