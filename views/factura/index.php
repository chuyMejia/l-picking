<?php


//var_dump($result);

//var_dump($_SESSION['identity']['id']);






$id_user = $_SESSION['identity']['id'];
?>

<style>
#div1 {
     overflow:scroll;
     height:200px;
     width:750px;
}
#div1 table {
    width:100%;
    background-color:lightgray;
}
</style>

<div id = "alert_succes" style="display:none;" class="alert alert-success" role="alert">
    Factura REGISTRADA CORRECTAMENTE :)
</div>

<div id="alert_danger" style="display:none;" class="alert alert-danger" role="alert">
    Factura YA CUENTA CON REGISTRO ;(
</div>

<div id="alert_warning" style="display:none;" class="alert alert-warning" role="alert">
  Factura no PERTENECE  CROSSDOCK favor de retirar
</div>

<div style = "  display: flex;
                justify-content: space-around;">
<div class="card text-center" style="max-width: 22%;">
  <div class="card-header">
    Registro Factura
  </div>
  <div class="card-body">
    <h5 class="card-title">Favor ingresar Factura</h5>
    <form id="facturaForm">
      <input class="form-control" id="val_factura" type="text" placeholder="Factura...">
    </form>
  </div>
  <div class="card-footer text-muted">
    &copy; Travers tool
  </div>
</div>
<div>
<div class="jumbotron jumbotron-fluid" style = "min-width: 70%;display:block;box-shadow: 10px 10px 0px -7px rgba(128,128,128,1);margin-top:1%;display:none;">

<div style= "display: flex;
    justify-content: flex-end;">
<a style="color:white;"href="#" class="badge badge-success">REGISTRADO</a> 
    </div>
<div class="container">
    <h1 class="display-4" id="cross">CROSS DOCK MTY</h1>
    <hr class="my-4">
    <h3 id="factura_">FQ124565</h3>
    <p id='nombre_' class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
    <p id="cliente_">GFHFHFH  DJDHDH</p>
    
  </div>
</div>
<h4>REGISTROS</h4>
<div id="div1">
<table class="table scroll">
  <thead class="thead-dark">
    <tr>
      <th scope="col">FACTURA</th>
      <th scope="col">CLIENTE</th>
      <th scope="col">NAME</th>
      <th scope="col">TIPO</th>
      
    </tr>
  </thead>
  <tbody>
            <?php foreach ($result as $item): ?>
                <tr style="background:white;">
                    <td><?php echo $item['Factura']; ?></td>
                    <td><?php echo $item['ORDERACCOUNT']; ?></td>
                    <td><?php echo $item['NAME']; ?></td>
                    <td><?php echo $item['CROSSDOCK']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
</table>
    </div>
    </div>




</div>
<script src="<?=base_url?>assets/dependencies/js/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function(){

    var user = "<?php echo $id_user ?>";

    $('#facturaForm').submit(function(event) {
      event.preventDefault(); 
      
      var factura = $('#val_factura').val();

      if(validarCodigo(factura) === false) {
        alert('Código inválido');
      } else {
        $.ajax({
          type: 'GET',
          url: "<?=base_url?>factura/save&TVR=1&FQ="+factura+"&USER="+user,
          success: function (response) {

            console.log(response);
            if(response['existe'] === true){
              $('#alert_danger').show('slow');
            } else if(response['existe'] ==="no es 29 o 30"){

                $('#alert_warning').show('slow');

                
                        $('#cross').html('404-NO ES CROSSDOCK');
                        $('#factura_').html('favor de retirar');
                        $('#nombre_').html('404 NOT FOUND');
                        $('#cliente_').html('404');
                        $('.jumbotron').show('slow');


            }else{
                if(response[0]['DLVMODE'] == 29 || response[0]['DLVMODE'] == '29'){
                    $(".jumbotron").css({
                                    "border": "solid #006c00",
                                    "background": "honeydew",
                                    "box-shadow": "10px 10px 0px -7px rgba(128,128,128,1)"
                                });
                }else{

                    $(".jumbotron").css({
                                    "border": "solid #001c77",
                                    "background": "#e6ecff",
                                    "box-shadow": "10px 10px 0px -7px rgba(128,128,128,1)"
                                });

                }
                

              $('#alert_succes').show('slow');
              $('#cross').html(response[0]['DLVMODE']+'-'+response[0]['CROSSDOCK']);
              $('#factura_').html(response[0]['InvoiceId']);
              $('#nombre_').html(response[0]['NAME']);
              $('#cliente_').html(response[0]['ORDERACCOUNT']);
              $('.jumbotron').show('slow');

              $('tbody').prepend(`<tr style="background:white;" ><td>${response[0]['InvoiceId']}</td><td>${response[0]['ORDERACCOUNT']}</td><td>${response[0]['NAME']}</td><td>${response[0]['CROSSDOCK']}</td></tr>`);

              /*
                    <th scope="col">FACTURA</th>
      <th scope="col">CLIENTE</th>
      <th scope="col">NAME</th>
      <th scope="col">TIPO</th>
              */

              /*
              $('tbody').prepend('<tr><td>5</td><td>dddddd</td><td>sssssssss</td><td>ddgd</td></tr>')
completar maña agreagr cada vez que se inserte un registro


y al cargar la pagina cargue todos lo registros index factura 
              */
            }
            console.log(response);
          },
          error: function (error) {
            console.error('Error en la solicitud AJAX', error);
          }
        });
      }

      setTimeout(function () {
        
        $('.alert').hide('slow');

        $('#val_factura').val('');
        
     
    }, 3500);



    });

    function validarCodigo(codigo) {
      // Expresión regular para validar el código
      var patron = /^(FQ|FM)\d{7}$/i;
      // Realizar la validación
      return patron.test(codigo);
    }
  });
</script>

