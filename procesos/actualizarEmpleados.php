<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    $datos=array(

        $_POST['nombreU'],
        $_POST['salarioU'],
        $_POST['tipoU'],
        $_POST['correoU'],
        $_POST['fechaU'],
        $_POST['cod_empleadoU']
        

    );

    echo $obj->actualizarEmpleado($datos);

?>