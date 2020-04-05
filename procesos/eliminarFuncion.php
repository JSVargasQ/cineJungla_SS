<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    echo $obj->eliminarFuncion( $_POST['cod_funcion'], $_POST['cod_multiplex']);
    
?>