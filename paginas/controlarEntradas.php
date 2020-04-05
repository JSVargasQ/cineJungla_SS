<?php 


include_once 'controlador/user.php';
include_once 'controlador/user_Sesion.php';



$userSession=new UserSession();
$user=new Usuario();

if (isset($_SESION['user'])){
	echo "Hay Sesion";
}else if(isset($_POST['username']) && isset($_POST['password']))
{
echo "validacion de login";
}else{
	echo "login";
	include_once 'login.php';
}
 ?>