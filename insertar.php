<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
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
		<?php include('nav.php');?>
	</nav>
	 <?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			date_default_timezone_set('America/Lima');
			$hoy =date("Y-m-d");
	                $nik =pg_escape_string($dbconn,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = pg_query($dbconn, "SELECT * FROM dominio WHERE coddominio='$nik'");		
			if(pg_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
			    $row = pg_fetch_assoc($sql);
			}
?>
	

	<div class="container" >
		<div class="content">
			<h2>Elementos de Datos&raquo; <?php echo $row ['nombredominio']; ?></h2>
			<hr />
			<form class="form-horizontal" id="formIndicador" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha</label>
					<div class="col-sm-2">
						<input type="text" class="form-control"  disabled="true" value="<?php echo $hoy;?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED identificados</label>
					<div class="col-sm-2">
						<input type="number"  id="numedident" name="numedident" class="form-control" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EDC identificados</label>
					<div class="col-sm-2">
						<input type="number" id="numedcident" name="numedcident" class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EDC con DN* en el Catalog</label>
					<div class="col-sm-2">
						<input type="number" id="edccatalog"  name="edccatalog" class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EDNC con DN* en el Catalog</label>
					<div class="col-sm-2">
						<input type="number" id="ednccatalog" name="ednccatalog"  class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Reglas de Negocio Definidas</label>
					<div class="col-sm-2">
						<input type="number" id="rndefinidas" name="rndefinidas"  class="form-control" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">RN* Implementadas, Activas y Ejecutando</label>
					<div class="col-sm-2">
						<input type="number" id="rnimplactejec"  name="rnimplactejec" class="form-control"  required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">RN* Implementadas que fueron desactivadas</label>
					<div class="col-sm-2">
						<input type="number" id="rndesact"  name="rndesact" class="form-control" required onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED con Trazabilidad en el Catalog</label>
					<div class="col-sm-2">
						<input type="number" id="edtrazacatalog" name="edtrazacatalog"  class="form-control" required  onkeypress='return validaNumericos(event)'/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ED con Trazabilidad fuera del Catalog</label>
					<div class="col-sm-2">
						<input type="number" id="edtrazafueracatalog" name="edtrazafueracatalog" class="form-control" required onkeypress='return validaNumericos(event)'/>
				                <input type="hidden" id="coddominio" type="hidden" name="coddominio"  class="form-control" value="<?php echo $nik;?>">
	
					</div>
				</div>
				<div class="form-group">
				      <label class="col-sm-3 control-label">*DN=Diccionario de Negocio</label>
				      <label class="col-sm-3 control-label">*RN=Regla de Negocio</label>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col">
						<input id="btnguardar" type="submit" name="add" class="btn btn btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="jquery/jquery-3.2.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script type="text/javascript">
		function validaNumericos(event) {
           if(event.charCode >= 48 && event.charCode <= 57){
                return true;
            }
          return false;         
         }
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnguardar').click(function(){
				var datos=$('#formIndicador').serialize();
			        var numedident =  $.trim($("#numedident").val());
                                var numedcident =  $.trim($("#numedcident").val());
                                var edccatalog =  $.trim($("#edccatalog").val());
                                var ednccatalog =  $.trim($("#ednccatalog").val());
                                var rndefinidas =  $.trim($("#rndefinidas").val());
                                var rnimplactejec =  $.trim($("#rnimplactejec").val());
                                var rndesact =  $.trim($("#rndesact").val());
                                var edtrazacatalog =  $.trim($("#edtrazacatalog").val());
   				var edtrazafueracatalog =  $.trim($("#edtrazafueracatalog").val());
			       if(numedident.length == "" || numedcident.length == ""  || edccatalog.length == ""  || ednccatalog.length == "" 
                                 || rndefinidas.length == "" || rnimplactejec.length == "" || rndesact.length == ""  || edtrazacatalog.length == ""
                                 || edtrazafueracatalog.length == "" ){
				       Swal.fire({
					   type:'warning',
					   title:'Debe ingresar valores',
				       });
      				return false;
   				}else {
				    $.ajax({
					type:"POST",
					url:"insert.php",
					data:datos,
					success:function(r){
						if(r==1){
							 Swal.fire({
							   	type:'error',
							   	title:'Error al guardar datos',
					                 });
						}else{
							 Swal.fire({
								 type:'success',
								 title:'Registrado correctamente',
								 confirmButtonText:'Ok',
     				                         }).then((result) => {
								    if(result.value){
								      window.location.href="index.php";
								    }
								  }
							       )
						}
					  }
				     });
				   return false;
				  }
			         });
		         });
	</script>
</body>
</html>
