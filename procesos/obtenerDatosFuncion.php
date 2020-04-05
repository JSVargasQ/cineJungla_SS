<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    echo json_encode( $obj->obtenerDatosFuncion( $_POST['cod_funcion'], $_POST['cod_multiplex']) );
    
?>