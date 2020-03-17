<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos del dominio</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>


	<style>
		.content {
			margin-top: 80px;
		}
	</style>


</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de dominios</h2>
			<hr />
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                                   <th>No</th>
				   <th>Nombre de Dominio</th>
			           <th>Owner</th>
                  		   <th>Custodio de Información</th>
			           <th>Indicador</th>
				</tr>
				<?php
				
					$result = pg_query($dbconn, "SELECT a.*, b.nombreusuario FROM dominio a join usuario b on a.codusuario = b.codusuario order by
			    b.nombreusuario");
				
				if(pg_num_rows ($result) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = pg_fetch_assoc($result)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['nombredominio'].'</td>
							<td>'.$row['owner'].'</td>
							<td>'.$row['nombreusuario'].'</td>
							<td>
							    <a href="insertar.php?nik='.$row['nombredominio'].'?20&&&?cod='.$row['coddominio'].'" title="Indicador" class="btn btn-success btn"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy; Sistemas Web <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
