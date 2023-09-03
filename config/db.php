<?php

class database {

  public static function conectar(){

  	$db = new mysqli('localhost','root','','tienda_master');

  	$db->query(" SET NAMES 'utf8' ");
  	return $db;

  }


}

?>


