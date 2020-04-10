<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    $datos=array(

        $_POST['sala'],
        $_POST['pelicula'],
        $_POST['dias'],
        $_POST['fecha'],
        $_POST['hora']

    );

    echo $obj->agregarFuncion($datos);

?>