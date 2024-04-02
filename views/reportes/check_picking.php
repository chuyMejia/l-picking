<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Evitar Envío de Formulario</title>
</head>
<body>
  <div class="card_form">
  <div class="card" style="width: 18rem;">
    <div class="card-body" style = "box-shadow: 14px 14px 0px -4px rgba(216,216,216,0.54);">
      <h5 class="card-title">l-PICKING REGISTROS</h5>
      <form action="<?= base_url ?>reportes/Lpicking2" method="post">
        <label>De:</label>
        <input name="de" type="date"></input>

        <label>Hasta:</label>
        <input name="hasta" type="date"></input>
        
        <label>Tipos de registros</label>
        <select name="opcion">
          <option value="" disabled selected>Selecciona una opción</option>
          <option value="4">Ambos</option>
          <option value="1">Completos</option>
          <option value="0">Incompletos</option>
          
        </select>

        <button type="submit"  class="btn">Enviar</button>

        <!-- <button type="submit" onClick="envio_data(event);" class="btn">Enviar</button> -->
      </form>
    </div>
  </div>
</div>

  <script>
    var envio_data = function(e){
      e.preventDefault();
      alert('Se envía data');
    }
  </script>
</body>
</html>
