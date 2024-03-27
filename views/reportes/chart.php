<?php


// Obtener el número del día de la semana (0 para domingo, 1 para lunes, ..., 6 para sábado)
$dayOfWeek = date('N');

// Calcular la diferencia de días entre el día actual y el lunes
$daysToMonday = 1 - $dayOfWeek;

// Si el día actual es lunes o posterior, sumar días para llegar al próximo lunes
if ($daysToMonday > 0) {
    $daysToMonday -= 7;
}

// Calcular la fecha del primer lunes de la semana
$firstMonday = date('Y-m-d', strtotime("$daysToMonday days"));

// Calcular la fecha del viernes de la semana
$friday = date('Y-m-d', strtotime("$firstMonday +4 days"));






$incompletos = $result_2[1]['COMPLETOS'];
//var_dump($exec[1]['registros']);
$completos = $result_2[0]['COMPLETOS'];


$dataArray = json_decode($result, true);

// Arreglo para almacenar los nombres de usuario y la cantidad de registros
$usuariosRegistros = array();

// Recorrer el array asociativo para obtener los nombres de usuario y la cantidad de registros
foreach ($dataArray as $item) {
    // Verificar si el campo 'usuario' está definido y no es nulo
    if (isset($item['usuario']) && !is_null($item['usuario'])) {
        // Almacenar la cantidad de registros para cada usuario
        $usuariosRegistros[$item['usuario']] = $item['REGISTROS'];
    }
}

// Imprimir el arreglo de nombres de usuario y cantidad de registros
//print_r($usuariosRegistros);

//var_dump($usuariosRegistros);

//die();


if(isset($incompletos)){
  //$incompletos = $b_result['COMPLETOS'];
}else{
//   $incompletos = $b_result[0]['INCOMPLETOS'];
//   $completos = $b_result[0]['COMPLETOS'];

  $incompletos = 2;
  $completos = 100;

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

//var_dump($semana['mar']['completos']);

// Mostrar el array actualizado $semana

// var_dump($semana);

// die();

//1485714
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

<h5 style="color:gray;">Chart's Registro L-Picking</h5>


<div style = "display: flex;justify-content: center;padding-top: 3%;">

    <div><canvas id="myChart" width="400" height="400"></canvas> </div>

    <div style="width: 20%; margin: auto;">


        <h5>REGISTROS</h5><p> semana (<?=date('W');?>)</p>
            <p style="color:gray">Pickings Completos:<strong><?=$completos?></strong></p>
            <p style="color:gray">Pickings inCompletos:<strong><?=$incompletos?></strong></p>
            <canvas id="graficaPastel"></canvas>
  </div>

  <div style="">
    
        <canvas id="pieChart">

        </canvas>


    
  </div>
 </div>

<div>










<div class="row">
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text" style="display: flex;justify-content: space-between;">Registros correcpondientes a la semana actual semana (<?=date('W');?>)  / <?=$firstMonday;?> -  <?=$friday?>      

        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
    </svg>
            </span>
        </div>
        </div>
    </div>

    <div>



</div>

<h5 style="color:gray;">Chart's Catalogo</h5>


<div style="display:flex;">
<div style="width: 33%;height: auto;"><canvas id="myChart_cat" width="400" height="400"></canvas></div>

<div style="width: 33%;height: auto;"><canvas style="border: 2px solid #c6c6c6;border-radius: 0.3rem;" id="horizontalBarChart"></canvas></div>
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

    
     
        // const data1 = [1,5,4,3,2];
        // const data2 = [0,0,0,1,1];
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


<script>

    // Convertir el arreglo asociativo PHP en JavaScript
    var usuariosRegistros = <?php echo json_encode($usuariosRegistros); ?>;

    // Obtener las claves (nombres de usuario) del arreglo
    var usuarios = Object.keys(usuariosRegistros);

    // Obtener los valores (cantidad de registros) del arreglo
    var cantidadRegistros = Object.values(usuariosRegistros);

    // Imprimir los arreglos para verificar
    console.log(usuarios);
    console.log(cantidadRegistros);

    // Configuración del gráfico
    var config_user = {
        type: 'pie',
        data: {
            labels: usuarios,
            datasets: [{
                label: 'Cantidad de Registros',
                data: cantidadRegistros,
                backgroundColor: [
                    'rgba(197, 255, 187, 0.8)',
                    'rgba(179, 238, 255, 0.8)',
                    'rgba(255, 248, 166, 0.8)',
                    'rgba(255, 161, 250, 0.8)',
                    'rgba(79, 155, 255, 0.8)',
                    'rgba(212, 255, 88, 0.8)'

                    
                ],
                borderColor: [
                    // 'rgba(255, 99, 132, 1)',
                    // 'rgba(54, 162, 235, 1)',
                    // 'rgba(255, 206, 86, 1)'
                    'gray'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Cantidad de Registros por Usuario'
            }
        }
    };

    // Obtener el contexto del lienzo
    var ctx_user = document.getElementById('pieChart').getContext('2d');

    // Crear la instancia del gráfico de pastel
    var pieChart = new Chart(ctx_user, config_user);
</script>



<script>
       // Datos de ejemplo
var data = {
    labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
    datasets: [{
        label: 'Puntos de Datos',
        data: [<?=$exec_catalog[0]['LUNES']?>, <?=$exec_catalog[0]['MARTES']?>, <?=$exec_catalog[0]['MIERCOLES']?>, <?=$exec_catalog[0]['JUEVES']?>, <?=$exec_catalog[0]['VIERNES']?>],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: '#009688',
        pointBackgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de los puntos
        pointBorderColor: 'rgb(75, 192, 192)', // Color del borde de los puntos
        pointBorderWidth: 2, // Ancho del borde de los puntos
        pointRadius: 6 // Radio de los puntos
    }]
};

// Opciones del gráfico
var options = {
    scales: {
        y: {
            beginAtZero: true
        }
    }
};

// Configurar el gráfico
var ctxCat = document.getElementById('myChart_cat').getContext('2d');
var myChart_ = new Chart(ctxCat, {
    type: 'line',
    data: data,
    options: options
});

    </script>

<script>
    // Datos de ejemplo
    var data = {
      labels: ['A', 'B', 'C', 'D', 'E'],
      datasets: [{
        label: 'Puntos de Datos',
        data: [12, 19, 3, 5, 2],
        backgroundColor: 'rgba(255, 99, 132, 0.7)', // Color de las barras
        borderColor: 'rgba(255, 99, 132, 1)', // Color del borde de las barras
        borderWidth: 1 // Ancho del borde de las barras
      }]
    };

    // Opciones del gráfico
    var options = {
      indexAxis: 'y', // Barras laterales
      animation: {
        duration: 2000, // Duración de la animación en milisegundos
        easing: 'easeInOutQuart', // Función de aceleración
      },
      scales: {
        x: {
          beginAtZero: true // Empezar el eje X desde cero
        }
      }
    };

    // Configurar el gráfico
    var ctx_lat = document.getElementById('horizontalBarChart').getContext('2d');
    var horizontalBarChart = new Chart(ctx_lat, {
      type: 'bar',
      data: data,
      options: options
    });
  </script>



<div>