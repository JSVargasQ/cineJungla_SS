
<?php 
	include_once 'user_Sesion.php';


	$Usersesion= new UserSession();
	$Usersesion->closeSession();

	header("location: ../index.php");


 ?>