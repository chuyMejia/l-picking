<?php
$incompletos = $exec[0]['registros'];
//var_dump($exec[1]['registros']);
$completos = $exec[1]['registros'];

if(isset($incompletos)){
  //$incompletos = $b_result['COMPLETOS'];
}else{
  $incompletos = $b_result[0]['INCOMPLETOS'];
  $completos = $b_result[0]['COMPLETOS'];
}

//var_dump($b_result[0]);


$semana = array(
  'lunes' => array('completos' => 0, 'incompletos' => 0),
  'martes' => array('completos' => 0, 'incompletos' => 0),
  'miercoles' => array('completos' => 0, 'incompletos' => 0),
  'jueves' => array('completos' => 0, 'incompletos' => 0),
  'viernes' => array('completos' => 0, 'incompletos' => 0)
);

// Recorrer el array $exec_semana y actualizar el array $semana
foreach ($exec_semana as $dia) {
  $nombreDia = strtolower($dia['DAY_']);

  // Verificar si el tipo es 'completos' o 'incompletos'
  $tipo = $dia['tipo'];

  // Actualizar el array $semana
  $semana[$nombreDia][$tipo] = $dia['registros'];
}

// Mostrar el array actualizado $semana
//var_dump($semana);

//die();

//var_dump($exec_semana);
// $semana = array(
//   'lunes' => array(
//       'completos' => 0,
//       'incompletos' => 10
//   ),
//   'martes' => array(
//       'completos' => 0,
//       'incompletos' => 10
//   ),
//   'miercoles' => array(
//       'completos' => 0,
//       'incompletos' => 10
//   ),
//   'jueves' => array(
//       'completos' => 0,
//       'incompletos' => 10
//   ),
//   'viernes' => array(
//       'completos' => 0,
//       'incompletos' => 10
//   )
// );

// // var_dump($semana);

// // die();



// for($i = 0;$i < count($exec_semana) ;$i++){
//   echo $exec_semana[$i]['DAY_'];
//   echo $exec_semana[$i]['registros'];
//   echo $exec_semana[$i]['tipo'];
//   echo $exec_semana[$i]['num_dia'];
//   echo "<br>";
//   if($exec_semana[$i]['DAY_'] == 'VIR' && $exec_semana[$i]['tipo'] == 'completos' ){
//     $semana['viernes']['completos'] = $exec_semana[$i]['registros'];
//   }

// }


//die();
//echo $completos;

//var_dump($semana);
?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/materialize-css@1.0.0/dist/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/materialize-css@1.0.0/dist/css/materialize.min.css">




<div style = "display: flex;justify-content: center;padding-top: 3%;">

 <div><canvas id="myChart" width="400" height="400"></canvas> </div>
  <!-- <div style="max-width: 20%;">
    <p>Pickings Completos:<strong><?=$completos?></strong></p>
    <p>Pickings Completos:<strong><?=$incompletos?></strong></p>
    <canvas id="myChart2"></canvas>
  </div> -->

  <div style="width: 20%; margin: auto;">
  <h4>REGISTROS</h4>
    <p style="color:gray">Pickings Completos:<strong><?=$completos?></strong></p>
    <p style="color:gray">Pickings Completos:<strong><?=$incompletos?></strong></p>
    <canvas id="graficaPastel"></canvas>
  </div>

  <div style="">

  <form action="<?= base_url ?>picking/detail" method="post">
      <label>De:</label>
      <input name="de_" type="date"></input>

      <label>Hasta:</label>
      <input name="hasta_" type="date"></input>

      <div class="input-field col s12">
        <select name="opcion" style="">
          <option value="" disabled selected>Selecciona una opción</option>
          <option value="1">Completos</option>
          <option value="0">Incompletos</option>
        
        </select>
        <label>Selecciona</label>
      </div>

      <button type="submit" class="btn">Enviar</button>
    </form>

    <!-- <canvas id="myChart"></canvas> -->
  </div>
 </div>

<div>
<div class="row">
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
      </div>
    </div>
  </div>

  <div>



</div>
    <script>
    $(document).ready(function(){
      $('select').formSelect();
    });
  </script>

    <script>


    

        //console.log(semana);

        // Obtén la fecha actual
        const currentDate = new Date();

        // Ajusta la fecha al primer día de la semana actual (lunes)
        currentDate.setDate(currentDate.getDate() - currentDate.getDay() + 1);

        // Calcula los días laborables de la semana actual junto con sus fechas
        const weekdaysWithDates = [];
        for (let i = 0; i < 5; i++) {
            const day = new Date(currentDate);
            day.setDate(day.getDate() + i);

            const dayName = new Intl.DateTimeFormat('en-US', { weekday: 'long' }).format(day);
            const dateFormat = new Intl.DateTimeFormat('en-US', { month: 'numeric', day: 'numeric', year: 'numeric' });
            const dateString = dateFormat.format(day);

            weekdaysWithDates.push(`${dayName} ${dateString}`);
        }

        // Datos para las barras dobles (puedes ajustar estos valores según tus necesidades)
        const data1 = [<?=$semana['lun']['completos']?>, <?=$semana['mar']['completos']?>, <?=$semana['mier']['completos']?>, <?=$semana['jue']['completos']?>, <?=$semana['vir']['completos']?>];
        const data2 = [<?=$semana['lun']['incompletos']?>, <?=$semana['mar']['incompletos']?>, <?=$semana['mier']['incompletos']?>, <?=$semana['jue']['incompletos']?>, <?=$semana['vir']['incompletos']?>];

        // Configuración del gráfico
        const config = {
            type: 'bar',
            data: {
                labels: weekdaysWithDates,
                datasets: [{
                    label: 'Completos',
                    data: data1,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }, {
                    label: 'Incompletos',
                    data: data2,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Obtén el contexto del lienzo
        const ctx = document.getElementById('myChart').getContext('2d');

        // Crea el gráfico con la configuración
        const myChart = new Chart(ctx, config);


        
    </script>



<script>
    // Datos para la gráfica de pastel
    var datos = {
      labels: ['Completos', 'Incompletos'],
      datasets: [{
        data: [<?=$completos?>, <?=$incompletos?>], // Valores para cada porción del pastel
        backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'], // Colores para cada porción
        borderColor: ['rgb(75, 192, 192)','rgb(255, 99, 132)']
      }]
    };

    // Obtener el contexto del lienzo
    var ctx2 = document.getElementById('graficaPastel').getContext('2d');

    // Crear la gráfica de pastel
    var graficaPastel = new Chart(ctx2, {
      type: 'pie',
      data: datos
    });
  </script>


<div>