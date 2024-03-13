<?php




?>

<!-- Incluye las bibliotecas de DataTables y los botones -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="<?=base_url?>assets/bootstrap-4.0.0/js/bootstrap.min.js"></script>

<!-- Incluye DataTables Buttons por separado -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>






 <!-- <form  action="<?=base_url?>picking/check2" method="POST">
	<label for="nPicking" >Num Picking:</label>
	<input type="text" name="nPicking" required="">
</form>  -->

<?php //echo base_url.'picking/rev';
    //die();
?>
<div>
	<label for="nPicking" >Num Picking:</label>
	<input id="nPicking" type="text" name="nPicking" required="">
</div>


<!-- Large modal -->
<button type="button" onClick="setData2();" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contenido de Picking <span id="result"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    
  </div>
</div>




<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




<script>





function setData(){

var nPicking_data =   $('#nPicking').val();    

var datos = {
            nPicking : nPicking_data,
                    
                };

                $.ajax({
                type: "POST",
                url: "http://192.168.1.235/tienda-PHP/index.php?controller=picking&action=saveData&TVR=1",
                data: datos,
                //dataType: "json",
                success: function(response) {
                   console.log(response);
                },
                error: function(error) {
                    console.error("Error en la petición:", error);
                }
            });

}
function setData2() {
    var nPicking_data = $('#nPicking').val();
    $('#result').html(nPicking_data);

    var datos = {
        nPicking: nPicking_data,
    };

    $.ajax({
        type: "GET",
        url: "http://10.1.1.25:3700/L-Picking/" + nPicking_data,
        success: function (response) {
            console.log(response.data);

            // Eliminar la tabla anterior si existe
            if ($.fn.DataTable.isDataTable('#modalTable')) {
                $('#modalTable').DataTable().destroy();
                $('#modalTable').remove();
            }

            // Construir la nueva tabla
            var html = `<table class="display" id="modalTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CLAVE</th>
                                    <th>DESCRIPCION</th>
                                    <th>CANTIDAD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>`;

            for (var i = 0; i < response.data.length; i++) {
                html += `<tr>
                            <td>${i + 1}</td>
                            <td>${response.data[i]['Clave']}</td>
                            <td>${response.data[i]['Descrip']}</td>
                            <td><input cant="${response.data[i]['Cant']}" onChange="data_(this,'${response.data[i]['Clave']}');" type="number" name="data" required=""></td>
                            <td><span id="${response.data[i]['Clave']}" cant="${response.data[i]['Cant']}"></span></td>
                        </tr>`;
            }

            html += `</tbody></table>`;

            // Agregar la nueva tabla al modal
            $('.modal-body').append(html);

            // Inicializar DataTable con botón de impresión
            var table = $('#modalTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            // Manera alternativa de agregar el botón de impresión
            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            table.buttons(0, null).container().appendTo($('.modal-body'));
        },
        error: function (error) {
            console.error("Error en la petición:", error);
        }
    });
}
function data_(e,id){

    console.log(id);
    //cantidad de base 
    var cantValue = $(e).attr('cant');
    //cantiad del input 
    var inputval = $(e).val();

    if(cantValue == inputval){
      //  alert('SIIIIIIIIIIIIII IGUALES'+id);
      $(e).css({'border': '2px solid green'});
        $('#'+id).html(`<svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg>`);

    }else{
        $(e).css({'border': '2px solid red'});
        $('#'+id).html(`<svg style="color: red;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
</svg>`);
    }



}


   
       
</script>