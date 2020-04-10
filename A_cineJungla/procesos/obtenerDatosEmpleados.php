<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    echo json_encode( $obj->obtenerDatosEmpleados( $_POST['cod_empleado']) );
    
?>