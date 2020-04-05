<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    echo $obj->desabilitarSala( $_POST['cod_sala'], $_POST['cod_multiplex']);
    
?>