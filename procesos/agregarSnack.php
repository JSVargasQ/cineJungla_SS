<?php

require_once "../clases/conexion.php";
require_once "../clases/A_crud.php";
$obj= new A_crud();

$datos=array(
    
    $_POST['codigo'],
    $_POST['almacen'],
    $_POST['cantidad'],
    $_POST['multiplex']
    
);

echo $obj->agregarSnack($datos);

?>