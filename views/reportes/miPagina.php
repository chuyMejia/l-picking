<?php

var_dump($_SESSION['identity']['imagen']);




?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Barras</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>


<div style="display: flex;
    justify-content: center;
    margin-bottom: 1%;
    margin-top: 1%;"><span class="badge badge-success" id ="detail_">Show</span></div>





    <div class="card border-success mb-3" style="display:none;" style="max-width: 18rem;">
    <div class="card-header" style="color:#28a745;display: flex;justify-content: space-between;"> <span  class="badge badge-success detail_2"> <?=$_SESSION['identity']['nombre_usuario'] ?></span> <span  class="badge badge-danger detail_2" >X</span></div>
    <div class="card-body text-success">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nombre:</strong><?=$_SESSION['identity']['nombre'] ?></li>
            <li class="list-group-item"><strong>Privilegios:</strong><?=$_SESSION['identity']['tipo_usuario'] ?></li>
            <li class="list-group-item"><strong>Usuario:</strong> <?=$_SESSION['identity']['nombre_usuario'] ?></li>
            <li class="list-group-item"><strong>Foto:</strong><img style = "    max-width: 10%;
    border-radius: 0.3rem;
    border: 2px solid;" src="<?=base_url?>uploads/images/<?=$_SESSION['identity']['imagen']?>"></img> </li>
            <li class="list-group-item"><strong>Cargar/Cambiar Imagen:</strong><div><input type="file" id="fileToUpload"> <button onclick="upload_image(<?=$_SESSION['identity']['nombre_usuario']?>);">Cargar Imagen</button></div></li>
        </ul>
    </div>
</div>


<div>


<h3 id="decha " style="display:none;"></h3>

<div class="card_form" style="display: flex;
    max-height: 100%;
    justify-content: space-around;">
    <div class="card" style="width: 18rem;">
                            <div class="card-body" style = "box-shadow: 14px 14px 0px -4px rgba(216,216,216,0.54);">
                                <h5 class="card-title">MI-PAGINA</h5>
                                <h4></h4>
                                <card>
                                <label>De:</label>
                                <input name="de" type="date"></input>

                                <button type="submit" onclick="chuy();" class="btn">Enviar</button>
                                </card>
                            </div>
                        </div>
         <canvas id="myChart" style="max-width:50%;background-color:;"></canvas> 
    

    
</div>
    <script>
       

        // Datos para la gráfica
       



        $('#detail_').click(function(){

           // $('.card').show('slow');
            $('.border-success').slideDown();
          
        })

        $('.detail_2').click(function(){

           // $('.card').hide('slow');

            $('.border-success').slideUp(); 
            $('#detail_').show('slow');

        });

        function chuy(){



            

    

            
           console.log($('[name=de]').val());
           var fecha_ = $('[name=de]').val();

           $('#fecha').show();
           $('#fecha').html('');
           $('#fecha').html('FECHA:<strong>'+fecha_+'</strong>');


           $('.card_form').html('');
           $('.card_form').html(`<div class="card" style="width: 18rem;">
                                    <div class="card-body" style = "box-shadow: 14px 14px 0px -4px rgba(216,216,216,0.54);">
                                        <h5 class="card-title">MI-PAGINA</h5>
                                        <h4></h4>
                                        <card>
                                        <label>De:</label>
                                        <input name="de" type="date"></input>

                                        <button type="submit" onclick="chuy();" class="btn">Enviar</button>
                                    </card>
                                    </div>
                                 </div>
                             <canvas id="myChart" style="max-width:50%;background-color:;"></canvas> `);


           
                    $.ajax({
                    type: 'POST',
                    //url: "http://192.168.1.235/lista-Picking/index.php?controller=picking&action=saveData&TVR=1&RPI=" + rpi_,
                    url: "<?=base_url?>index.php?controller=reportes&action=chuy&TVR=1",
                    //data: 'data=' + encodeURIComponent(jsonData), // Enviar el JSON como parte de los datos
                    data: { fecha: fecha_,
                       user:<?=$_SESSION['identity']['nombre_usuario'];?> },
                    success: function (response) {
                        cadena = response.replace(/\s/g, '');
                        // Dividir la cadena en función de "|"
                        var partes = response.split("|");
                        console.log(partes); // Esto imprimirá ["", "2", "183", ""]
                        // Eliminar el primer y último elementos del array resultante si son cadenas vacías
                        if (partes[0] === '') partes.shift();
                        if (partes[partes.length - 1] === '') partes.pop();
                        console.log(partes); // Esto imprimirá ["2", "183"]

                        console.log(partes[1]);
                        console.log(partes[2]);


                                        var data = {
                            labels: ['inCompletos', 'Completos'],
                            datasets: [{
                                label: 'Ventas',
                                data: [partes[1],partes[2]],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                ],
                                borderWidth: 1
                            }]
                        };

                            // Opciones para la gráfica
                            const options = {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            };

                // Crear gráfica de barras
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options
                });

                      //  $('.alert3').show();
                        // setTimeout(function () {
                        //     // Recargar la página actual
                        
                        //     location.reload();
                        // }, 2000);

                    },
                    error: function (error) {
                        console.error('Error en la solicitud AJAX', error);
                    }
                    });

           
           
        }




// Define la función upload_image fuera de $(document).ready()
function upload_image(id) {

    //alert(id);
    var fileInput = document.getElementById('fileToUpload'); // Obtener referencia al elemento de entrada de archivo
    var file = fileInput.files[0]; // Obtener el archivo seleccionado

    var formData = new FormData(); // Crear un objeto FormData
    formData.append('imagen', file); // Agregar el archivo al objeto FormData

    $.ajax({
        type: 'POST',
        url: '<?=base_url?>index.php?controller=usuario&action=upload_image&TVR=1&userid='+id,
        data: formData, // Enviar FormData en lugar de un objeto plano
        processData: false, // No procesar los datos
        contentType: false, // No establecer el tipo de contenido
        success: function(response) {
            console.log('Imagen subida correctamente:', response);
            location.reload();
        },
        error: function(error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

$('document').ready(function() {
    // Este es el código que se ejecuta cuando el DOM está completamente cargado

    // Ahora puedes llamar a la función upload_image en cualquier lugar del código después de que el DOM esté cargado
});

        

     

    </script>
</body>
</html>
