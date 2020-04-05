<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    echo $obj->habilitarEmpleado( $_POST['cod_empleado']);
    
?>