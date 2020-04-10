<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    echo $obj->habilitarEmpleado( $_POST['cod_empleado']);
    
?>