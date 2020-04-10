<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    echo $obj->deshabilitarSala( $_POST['cod_sala'], $_POST['cod_multiplex']);
    
?>