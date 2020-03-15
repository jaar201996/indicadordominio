<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<!--
Project      : Datos de empleados con PHP, MySQLi y Bootstrap CRUD  (Create, read, Update, Delete) 
Author		 : Obed Alvarado
Website		 : http://www.obedalvarado.pw
Blog         : http://obedalvarado.pw/blog/
Email	 	 : info@obedalvarado.pw
-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Elementos de Datos</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
			margin-left: 250px;
		}

	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			date_default_timezone_set('America/Lima');
			$hoy =date("Y-m-d");
	                $nik =pg_escape_string($dbconn,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql =  pg_query($dbconn, "SELECT * FROM dominio WHERE nombredominio='$nik'");
			if(pg_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = pg_fetch_assoc($sql);
			}
	               
			
	?>
	
	<?php
			if(isset($_POST['add'])){
				$numedident		     = pg_escape_string($dbconn,(strip_tags($_POST["numedident"],ENT_QUOTES)));//Escanpando caracteres 
				$numedcident		     = pg_escape_string($dbconn,(strip_tags($_POST["numedcident"],ENT_QUOTES)));//Escanpando caracteres 
				$edccatalog	 = pg_escape_string($dbconn,(strip_tags($_POST["edccatalog"],ENT_QUOTES)));//Escanpando caracteres 
				$ednccatalog	 = pg_escape_string($dbconn,(strip_tags($_POST["ednccatalog"],ENT_QUOTES)));//Escanpando caracteres 
				$rndefinidas	     = pg_escape_string($dbconn,(strip_tags($_POST["rndefinidas"],ENT_QUOTES)));//Escanpando caracteres 
				$rnimplactejec		 = pg_escape_string($dbconn,(strip_tags($_POST["rnimplactejec"],ENT_QUOTES)));//Escanpando caracteres 
				$rndesact		 = pg_escape_string($dbconn,(strip_tags($_POST["rndesact"],ENT_QUOTES)));//Escanpando caracteres 
				$edtrazacatalog			 = pg_escape_string($dbconn,(strip_tags($_POST["edtrazacatalog"],ENT_QUOTES)));//Escanpando caracteres 
				$edtrazafueracatalog			 = pg_escape_string($dbconn,(strip_tags($_POST["edtrazafueracatalog"],ENT_QUOTES)));//Escanpando caracteres 
				$date = date("Y-m-d H:i:s");
				
						$insert = pg_query($dbconn, "INSERT INTO indicador(coddominio, numedident, numedcident, edccatalog, ednccatalog, rndefinidas, rnimplactejec, rndesact,edtrazacatalog,fecactual,edtrazafueracatalog)
															VALUES('$row ['coddominio']','$numedident', '$numedcident', '$edccatalog', '$ednccatalog', '$rndefinidas', '$rnimplactejec', '$rndesact','$edtrazacatalog','$date','$edtrazafueracatalog')") or die("Fallo en insertar");
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
			}
?>
	
	<div class="container" >
		<div class="content">
			<h2>Elementos de Datos&raquo; <?php echo $nik; ?></h2>
			<hr />

			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha</label>
					<div class="col-sm-2">
						<input type="text" class="form-control"  disabled="true" value="<?php echo $hoy;?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED identificados</label>
					<div class="col-sm-2">
						<input type="number" name="numedident" class="form-control" value="<?php echo $row ['coddominio']; ?>" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EDC identificados</label>
					<div class="col-sm-2">
						<input type="number" name="numedcident" class="form-control" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED con DN* en el Catalog</label>
					<div class="col-sm-2">
						<input type="number" name="edccatalog" class="form-control" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EDNC con DN* en el Catalog</label>
					<div class="col-sm-2">
						<input type="number" name="ednccatalog"  class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Reglas de Negocio Definidas</label>
					<div class="col-sm-2">
						<input type="number" name="rndefinidas"  class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">RN* Implementadas, Activas y Ejecutando</label>
					<div class="col-sm-2">
						<input type="number" name="rnimplactejec" class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">RN* Implementadas que fueron desactivadas</label>
					<div class="col-sm-2">
						<input type="number" name="rndesact" class="form-control" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED con Trazabilidad en el Catalog</label>
					<div class="col-sm-2">
						<input type="number" name="edtrazacatalog"  class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED con Trazabilidad fuera del Catalog</label>
					<div class="col-sm-2">
						<input type="number" name="edtrazafueracatalog" class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>		
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col">
						<input type="submit" name="add" class="btn btn btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
	<script type="text/javascript">
		function validaNumericos(event) {
           if(event.charCode >= 48 && event.charCode <= 57){
                return true;
            }
          return false;         
         }
	</script>
</body>
</html>
