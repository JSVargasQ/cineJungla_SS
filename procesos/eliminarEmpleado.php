<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    echo $obj->eliminarEmpleado( $_POST['cod_empleado']);
    
?>