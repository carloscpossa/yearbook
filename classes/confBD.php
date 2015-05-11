<?php
 function conn_mysql(){

   $servidor = 'br-cdbr-azure-south-a.cloudapp.net';
   $porta = 3306;
   $banco = "yearbooAELXd4iE4";
   $usuario = "b91783299851f2";
   $senha = "9ff1f522";
   
      $conn = new PDO("mysql:host=$servidor;
	                   port=$porta;
					   dbname=$banco", 
					   $usuario, 
					   $senha,
					   array(PDO::ATTR_PERSISTENT => true)
					   );
      return $conn;
   }
?>