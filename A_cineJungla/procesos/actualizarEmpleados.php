<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

    $datos=array(

        $_POST['nombreU'],
        $_POST['salarioU'],
        $_POST['tipoU'],
        $_POST['correoU'],
        $_POST['cod_empleadoU']
        

    );

    echo $obj->actualizarEmpleado($datos);

?>