<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    $datos=array(

        $_POST['salaU'],
        $_POST['peliculaU'],
        $_POST['fechaU'],
        $_POST['horaU'],
        $_POST['multiplexU'],
        $_POST['cod_funcionU']
        

    );

    echo $obj->actualizarFuncion($datos);

?>