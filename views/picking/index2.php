<?php
//var_dump($_SESSION);

if(isset($_SESSION['identity'])){
?>



<link href="<?=base_url?>assets/bootstrap-4.0.0/assets/css/docs.min.css" rel="stylesheet">
<script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>

<!-- Incluye las bibliotecas de DataTables y los botones -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> -->

<link href="<?=base_url?>assets/dependencies/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="<?=base_url?>assets/dependencies/css/jquery.dataTables.css" rel="stylesheet">


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->

<script src="<?=base_url?>assets/dependencies/js/jquery.dataTables.js"></script>
<script src="<?=base_url?>assets/dependencies/js/jquery-3.6.0.min.js"></script>

<!-- <script src="<?=base_url?>assets/bootstrap-4.0.0/js/bootstrap.min.js"></script> -->
<!-- CSS de Bootstrap 5 -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="<?=base_url?>assets/dependencies/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url?>assets/dependencies/css/datatables.css" rel="stylesheet">
<link href="<?=base_url?>assets/dependencies/css/datatables.min.css" rel="stylesheet">

<!-- JS de Bootstrap 5 (requiere Popper.js) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->

<script src="<?=base_url?>assets/dependencies/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url?>assets/dependencies/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url?>assets/dependencies/js/buttons.html5.min.js"></script>

<script src="<?=base_url?>assets/dependencies/js/datatables.js"></script>
<script src="<?=base_url?>assets/dependencies/js/datatables.min.js"></script>



<div class="alert alert-warning" style="display:none;" role="alert">
  Cliente sin Mini-Catalogo <strong>Favor de incluir uno </strong>
  <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" style="color:gray" for="flexSwitchCheckDefault">Se incluyo  Mini-Catalogo</label>
  </div>
</div>

<div id="cont_master" style="display: flex;justify-content: space-between;margin-bottom: 16%;">

    <div class="card border-info mb-3" style="border-color: #ffffff !important;max-width: 18rem; margin-left: 10px;margin-top: 10px;box-shadow: 1px 1px 6px 2px rgba(143,143,143,0.89);">
    <div class="alert alert-danger" style="display:none;" id ="pick_cancel" role="alert">
 PICKING CANCELADO FAVOR DE RETIRAR ;]
</div>
    
    <div class="card-header" style="background: #313131;color: white;">PICKING</div>
        <div class="card-body text-info">
            <form class="form-inline" id="myForm">
                <div class="form-group mb-2">
                    <label for="staticEmail2" class="sr-only">Email</label>
                    <input type="text" class="form-control-plaintext" placeholder="RPI...." id="nPicking">
                </div>
            </form>

            <div>
                <form id="formulario">
                    <input id="input_e"></input>
                    <input style="width:15%;border: 1px solid #e12323;" id="input_cant" type="number"></input>
                    <input style="display:none;" type="submit"></input>
                </form>


              
                
           



                
            </div>

            
           

           
            
        </div>

        <div style="margin-top:10px;" class="shark-1" id = "im">
                
        </div>

        
             
    </div>
    <div style="background:red;">
    </div>
    <div id ="loader_" style ="width: 20%;height: auto; display: none;">
    <img style ="max-width: 100%;" src="<?=base_url?>assets/image/loader.gif"><img>
    </div>
    <div class="card border-infos mb-3" id="content_" style="margin-bottom: 1rem !important;margin-left: 10px;margin-top: 10px;box-shadow: 1px 1px 6px 2px rgba(143,143,143,0.89);display:none">

        <div class="alert alert2 alert-danger" id ="no_p"  style="display:none;" role="alert">
            El item
            <a href="#" id="exceso_sku" class="alert-link"></a>. excede favor de revisar.
        </div>

        <div class="alert alert3 alert-success" style="display:none;" role="alert">
            REGISTRO GUARDADO EXITOSAMENTE!
        </div>

        <div>
            <div>
            <div class="progress" >
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span id="percent" style="font-size: initial;">0%</span></div>
        </div> 
            <div id="div_content"></div>
            </div>
        </div>

    </div>

    <br>
 
<!--$('.progress-bar').css({'width': '100%'})-->
    <br><br>
    <br><br>
    <br><br>
    <br><br>

    
   <?php }else{
    echo "<h2>IDENTIFICATE</h2>";
  ?>
<a href="<?=base_url?>" >click aqui</a>

  <?php }?>
    <script>
        $(document).ready(function () {


            


            var contador = 0;

         


//Otra no especificada en el catalogo
            $('#nPicking').focus();

var conteo_lineas ;
var conteo_lineas_t;

            // Obtener el formulario por su ID
            var form = document.getElementById('myForm');

            // Agregar un evento de escucha para el evento keydown en el campo de entrada
            document.getElementById('nPicking').addEventListener('keydown', function (event) {
                // Verificar si la tecla presionada es "Enter" (código 13)
                if (event.keyCode === 13) {
                    // Mostrar una alerta (puedes personalizar esto según tus necesidades)
                    //alert('Se presionó la tecla Enter. Formulario no enviado.');
                    // Evitar el envío del formulario
                    event.preventDefault();
                    $('#loader_').show();
                    setData2();
                   // $('#loader_').hide(); 
                }
            });

            function setData2() {
    var nPicking_data = $('#nPicking').val();

    $('#div_content').html('');

    fetch('<?=base_url?>picking/check_&TVR=1&RPI='+nPicking_data)
    .then(response => response.json())
    .then(data => {
        // Verificar si la respuesta no está vacía
        if (data && data.length > 0) {
            // Hacer algo con los datos recibidos, si es necesario
            console.log('Datos obtenidos en la solicitud fetch:', data);
            // Continuar con la lógica principal
            //ejecutarLogicaPrincipal();



            $('#loader_').hide();
            alert('YA CUENTA CON REGISTRO');
            location.reload();

           
        } else {
            console.log('La respuesta de la solicitud fetch está vacía.');
            // Puedes realizar acciones adicionales en caso de una respuesta vacía
            //principal();

            //revisar si el picking esta cancelado
        
        principal();
            //principal();
        }
    })
    .catch(error => {
        console.error('Error en la solicitud fetch:', error);
    });


    //principal();
    

   
}


var principal = function(){

    var nPicking_data = $('#nPicking').val();

    $.ajax({
        type: "GET",
      //  url: "http://10.1.1.25:3700/L-Picking/" + nPicking_data,
      //url: "http://localhost/lista-Picking/picking/new_data&TVR=1&RPI="+nPicking_data,
      url: "<?=base_url?>picking/new_data&TVR=1&RPI="+nPicking_data,
      //url: "http://localhost/lista-Picking/picking/new_data&TVR=1&RPI=RPI1462043",
        success: function (response) {
                console.log(response[0]);

                if(response[0]['Resultado'] == 'canceled'){

                   // alert('PICKING CANCELADO');
                    $('#pick_cancel').show();
                    setTimeout(function () {
      
                    location.reload();
                }, 3500);

                    
                    //location.reload(); aqui quedo chuy 
                    //RPI1485750  picking cancelado pruebas 
                    return false;

                }

              //  alert('ddddddd');

            console.log(response[0]['CAT']);
            //alert(response.data);
            if(response[0]['CAT'] !== 'si'){

                $('.alert-warning').show('slow');

            }

            if ($.fn.DataTable.isDataTable('#modalTable')) {
                $('#modalTable').DataTable().destroy();
                $('#modalTable').remove();
            }
            $('#content_').show();
            var html = '';

             html = `<table class="table" id="modalTable">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CLAVE</th>
                    <th scope="col">UNIDAD</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>`;

               // alert(response.data.length);

               conteo_lineas = response.length;


               //alert(conteo_lineas);

               ///alert(conteo_lineas);

            for (var i = 0; i < response.length; i++) {
                html += `<tr>
                <td>${i + 1}</td>
                <td class="record mostar_img">${response[i]['Clave']}</td>
                <td>${response[i]['UNITID']}</td>
                <td>${response[i]['Descrip']}</td>
                <td><input readonly id="id-${response[i]['Clave']}" cant="${response[i]['Cant']}" onChange="data_(this,'${response[i]['Clave']}');" type="number" name="data" required=""></td>
                <td><span id="${response[i]['Clave']}" cant="${response[i]['Cant']}"></span></td>
                </tr>`;
            }

          

            html += `</tbody></table>
            <div style="display: flex;justify-content: center;margin-top: 4px;margin-bottom: 4px;">
            <button onClick="GuardarDatos();" type="button" class="btn btn-primary">Guardar</button><div>`;

            $('#div_content').append(html);
            $('#nPicking').prop('readonly', true);

               $('.mostar_img').mouseover(function(){
               // console.log($(this).html());
                imgs = $(this).html();
                var url_ = `https://www.travers.com.mx/media/catalog/product/agility/img/${imgs}_1.jpg`;
                console.log(url_);

                $('#im').html(`<img style="width:100%;margin-top: 10%;" src="${url_}">`);
            });


            $('#loader_').hide();
            $('#input_e').val('').focus();

            // Inicializar DataTable con botones
            // $('#modalTable').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [    
            //         'csv',
            //         'print'
            //     ]
            // });
        },
        error: function (error) {
            console.error("Error en la petición:", error);
        }
    });

}


            function data_(e, id,mass = 0) {
                $('.alert2').hide();

             

                console.log(id);
                //cantidad de base 
                var cantValue = $(e).attr('cant');
                cantValue = parseInt(cantValue);
                //cantiad del input 
                //aqui chuy 

                var inputval = $(e).val();
                if (isNaN(inputval) || inputval == "" ) {
                    inputval = 0;
                }else{
                    inputval  = parseInt(inputval);
                }
                
                
                

                if(mass != 0){
                    var valor_sum = parseInt(mass)+inputval;
                    //alert('mass');

                        if(cantValue <  valor_sum){
                            $('.alert2').show();
                        }else{
                            $(e).val(valor_sum);
                        }
                        

                
                    

                    console.log(parseInt(mass)+inputval);
                }
                var inputval = $(e).val();

                if (isNaN(inputval) || inputval == "" ) {
                    inputval = 0;
                }else{
                    inputval  = parseInt(inputval);
                }
                //alert(cantValue+'cantValue'+inputval+'inputval');

                ///aqui chuy

                //var porcentaje   = conteo_lineas;

                var individual = 100 / parseInt(conteo_lineas);

              

         






                if (cantValue == inputval) {
                    //  alert('SIIIIIIIIIIIIII IGUALES'+id);
                    $(e).css({ 'border': '2px solid green' });
                    $('#' + id).html(`<svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>`);

                         contador = contador +individual;

                         console.log('va en ------->'+contador);

                         $('.progress-bar').css({'width': contador+'%'});
                         $('#percent').html(contador+'%');
                         ///chuyomenoso

                        $(e).parent().parent().css({'background':'White'});

                } else {
                    $(e).css({ 'border': '2px solid red' });
                    $('#' + id).html(`<svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                        <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708"/>
                        </svg>`);
                        $(e).parent().parent().css({'background':'White'});
                    //$('.alert2').show();
                }
                $('#input_e').val('').focus();
                
                $('#input_cant').val('');

            }

            $('#formulario').on('submit', function (event) {
                event.preventDefault();

                console.log('chuy chuy  url');

               // alert(conteo_lineas);

                

                var sku = $('#input_e').val();
                var input = $('#id-' + sku);
                var cantValue = $(input).attr('cant');
                var valor_actual = input.val();

                   // alert(isNaN(input)); chuyomenoso


                imgs = $(this).html();
                var url_ = `https://www.travers.com.mx/media/catalog/product/agility/img/${sku}_1.jpg`;
                //console.log(url_);

                $('#im').html(`<img style="width:100%;margin-top: 10%;" src="${url_}">`);

             
                //alert(sku);

                if (valor_actual == '') {
                    //alert('vacio');
                    valor_actual = 0;
                }else if(typeof valor_actual === 'undefined'){
                    $('.alert2').show();
                    $('#exceso_sku').html(sku);
                    //alert('El valor es undefined');
                    breack;
                }else{
                    valor_actual =  parseInt(valor_actual);
                }

                //validacion de input cantidad
                var input_cantidad = $('#input_cant').val();

                if (input_cantidad != '') {
                    $('#exceso_sku').html(sku);

                    if (cantValue <= valor_actual) {
                        $('.alert2').show();

                       // alert('valor excedesssssssssssssssssss');

                        return false;
                        //break;
                    } else {
                       // input.val(input_cantidad); CHUYCHUY
                        data_(input, sku,input_cantidad);
                       // alert('INGRESO MASIVO');
                        return false;
                    }
                } else {
                    // Prevenir la ejecución del formulario
                    //alert('valor real es :'+cantValue);

                    $('#exceso_sku').html(sku);

                    if (input.val() == '') {
                        input.val(1);
                    } else {
                        if (cantValue <= valor_actual) {
                            $('.alert2').show();

                           //alert(cantValue+':cantValue'+valor_actual+':valor_actual');

                            //alert('valor excede');

                            return false;
                            //break;
                        } else {
                            input.val(parseInt(valor_actual) + 1);
                        }

                    }

                    data_(input, sku);

                  //  alert(sku);

                }
            });

            
        });

        var GuardarDatos = function () {

            var rpi_ = $('#nPicking').val();

            var miJSON = [];
            if(validacion() == false){
                var autoriza = prompt("Por favor, ingrese clave de autorización:");
                if(autoriza == 1146 || autoriza == '1146'){
                    alert('se autorizo con clave');
                }else{
                    alert('No se pude validar la clave');   
                }
            }

           if(validacion(autoriza)){


          //  alert(validacion());

            

            
$('tbody tr').each(function () {

var isCorect_;
var cant = $(this).find('td:eq(4) input').val();
var cat_real = $(this).find('td:eq(4) input').attr('cant');
var clave = $(this).find('td:eq(1)').html();

cat_real = parseFloat(cat_real);

//alert(cat_real);

cant = parseFloat(cant);

if (isNaN(cant)) {
    cant = 0;
}

if(cat_real == cant){
    isCorect_= 1
}else{
    isCorect_= 0
}



if (clave !== undefined) {

    var item = {
        "Cant": cant,
        "Clave": clave,
        "isCorrect":isCorect_
    };

    miJSON.push(item);
}
});
////chuy 1478548

//console.log(index);


//console.log(JSON.stringify(miJSON));
// Convertir el objeto JSON a una cadena
var jsonData = JSON.stringify(miJSON);

console.log(jsonData);

//Enviar la solicitud AJAX al controlador PHP

$.ajax({
type: 'POST',
//url: "http://192.168.1.235/lista-Picking/index.php?controller=picking&action=saveData&TVR=1&RPI=" + rpi_,
url: "<?=base_url?>index.php?controller=picking&action=saveData&TVR=1&RPI=" + rpi_,
//data: 'data=' + encodeURIComponent(jsonData), // Enviar el JSON como parte de los datos
data: { jsonData: jsonData },
success: function (response) {
    console.log(response);
    $('.alert3').show();
    setTimeout(function () {
        // Recargar la página actual
       
        location.reload();
    }, 2000);

},
error: function (error) {
    console.error('Error en la solicitud AJAX', error);
}
});

           }else{
            alert('NO SE PUDO PROCESAR');
            
           } 




}




var validacion = function(auto = 0){

    //alert('auto'+auto);

    if(auto == 1 || auto == '1'){

        return true ;

    }

    var bandera = false ;

    $('[name]').each(function(){
    var valor = $(this).val();
    var cant  = $(this).attr('cant');
    if(valor == ""){

        valor = 0;
    }
    if(valor != cant){
        //alert(this);
        $(this).parent().parent().css({'background':'#fffa82','color':'#ac0000'});

        bandera = true;
    }
    console.log(cant+'->'+valor);
   
    //console.log(valor);
    
})


 if(bandera == true){

        alert('No concuenrdan las cantidades, FAVOR DE REVISAR');
        return false;
    }else{

        //alert('todo bien');

        return true;
    }


          
       // alert('AQI VA LA VALIDACION');

}

$('#flexSwitchCheckDefault').change(function() {
        // Verificar si el checkbox está desactivado
        var rpi_ = $('#nPicking').val();

       
            if (!$(this).is(':checked')) {
            console.log('El checkbox está desactivado.');
            // Aquí puedes hacer lo que necesites cuando el checkbox esté desactivado
        } else {
            console.log('El checkbox está activado.');
            $.ajax({
                type: 'GET',
                //url: "http://192.168.1.235/lista-Picking/index.php?controller=picking&action=saveData&TVR=1&RPI=" + rpi_,
                url: "<?=base_url?>picking/catalogo&TVR=1&RPI=" + rpi_,
                //data: 'data=' + encodeURIComponent(jsonData), // Enviar el JSON como parte de los datos
                
                success: function (response) {
                    console.log(response);
                    $('.form-check').html('<p style ="color:#870000;">Dato Guardado Gracias :)</p>');

                    setTimeout(function () {
                        // Recargar la página actual
                        $('.alert-warning').hide('slow');
                        //location.reload();
                    }, 1500);

                    
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX', error);
                }
                });
        }


        
        
    });

//442 674094801
//442 674 0948
//442 403 4723




    </script>
</div>
