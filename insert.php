<?php 
	 include("conexion.php");
         date_default_timezone_set('America/Lima');
         $date = date("Y-m-d H:i:s");
          $insert = pg_query($dbconn, "INSERT INTO indicador(coddominio, numedident, numedcident, edccatalog, ednccatalog, rndefinidas, rnimplactejec, rndesact,edtrazacatalog,fecactual,edtrazafueracatalog)
															VALUES('$_GET[nik]',
															       '$_POST[numedident]',
															       '$_POST[numedcident]', 
															       '$_POST[edccatalog]',
															        '$_POST[ednccatalog]', 
															        '$_POST[rndefinidas]', 
															        '$_POST[rnimplactejec]', 
															        '$_POST[rndesact]',
															        '$_POST[edtrazacatalog]',
															        '$date',
															        '$_POST[edtrazafueracatalog]')") or die(pg_last_error($dbconn));
         }
?>
