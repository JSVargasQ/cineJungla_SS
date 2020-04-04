<?php

require_once "../clases/conexion.php";
require_once "../clases/crud.php";
$obj= new crud();

$datos=array(
    
    $_POST['codigo'],
    $_POST['cantidad']
    
);

echo $obj->agregarSnack($datos);

?>