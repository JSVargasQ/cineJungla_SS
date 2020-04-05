<?php

require_once "../clases/conexion.php";
require_once "../clases/A_crud.php";
$obj= new A_crud();

$datos=array(
    
    $_POST['codigo'],
    $_POST['cantidad']
    
);

echo $obj->agregarSnack($datos);

?>