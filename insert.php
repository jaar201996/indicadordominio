<?php 
	$conexion=mysqli_connect('localhost','root','','pruebas');

	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$usuario=$_POST['usuario'];
	$password=sha1($_POST['password']);

	$sql="INSERT into usuarios (nombre,apellido,usuario,password)
			values ('$nombre','$apellido','$usuario','$password')";
	echo mysqli_query($conexion,$sql);
 ?>