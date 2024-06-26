<?php






?>


<div style="display: flex;
    justify-content: center;
    padding: 4%;
    border: 7px solid gray;
    border-radius: 0.3rem;">
<form action="<?= base_url ?>picking/existencias2" method="POST">
    <label for="item" style= "font-family: monospace;
    font-size: x-large;
    color: #375472;
    font-weight: bold;">EXISTENCIAS</label>
    <input style="border: 2px solid black;" placeholder="Ingresa SKU" name="item" type="text" id="item">
    <input style="width: 100%;" type="submit" value="Enviar">
</form>
</div>