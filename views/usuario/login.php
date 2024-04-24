<?php







if(isset($identity)){

  //echo $identity;

  $_SESSION['login'] = true;

}
//var_dump($identity);
//echo $identity;
//die();


?>
<!-- 
<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


 -->

 <link href="<?=base_url?>assets/dependencies/css/materialize.min.css" rel="stylesheet">
<script src="<?=base_url?>assets/dependencies/js/materialize.min.js"></script>


<!------ Include the above in your HEAD tag ---------->

<?php  if(!isset($_SESSION['identity'])){    ?>

<div class="container">
	<div >
	<div class="section"></div>
   <main>
    <center>
     <div class="container">
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey green-text lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 0%; solid #EEE;">
        <div class="section" style ="    max-width: 50%;   border-radius: 1.3rem;">
    
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
  <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
</svg>
    
    </div>
            <div class="section">L-Picking</div>
    
      <div class="section"><i class="mdi-alert-error red-text"></i></div>
      
          <form method="POST" action="<?=base_url?>usuario/login_&TVR=1">
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type="text" name='user' id='user' required />
                <label for='email'>Username</label>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col m12'>
                <input class='validate' type='password' name='password' id='password' required />
                <label for='password'>Password</label>
              </div>
              <label style='float: right;'>
              <a><b style="color: #F5F5F5;">Forgot Password?</b></a>
              </label>
            </div>
            <br/>
            <center>
              <div class='row'>
                <!-- <button style="margin-left:65px;" onclick="chuy()" type='submit' name='btn_login' class='col  s6 btn btn-small white black-text  waves-effect z-depth-1 y-depth-1'>Login</button> -->
              <input type="submit"></input>
              </div>
            </center>
</form>
        </div>
       </div>
      </center>
      </main>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script> -->

    <script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url?>assets/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>

	</div>
</div>
<?php } elseif ($_SESSION['identity']["tipo_usuario"] == 'REPORT') {  ?>
   
  <script>
    // Redireccionar a otra página web
    window.location.href = '<?=base_url?>reportes/lineaVenta';
</script>

<?php
} 

else{ 
sleep(2);

echo '<h1>LOG IN</h1>';

//unset($_SESSION['identity']);
header('Location:'.base_url."picking/index2");

var_dump($_SESSION['identity']);
?>

<script>
    // Redireccionar a otra página web
    window.location.href = '<?=base_url?>picking/index2';
</script>



<?php }?>






<script>


var chuy  = function(){

  alert('action');

}


</script>