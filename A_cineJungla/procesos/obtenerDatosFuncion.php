<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    echo json_encode( $obj->obtenerDatosFuncion( $_POST['cod_funcion'], $_POST['cod_multiplex']) );
    
?>