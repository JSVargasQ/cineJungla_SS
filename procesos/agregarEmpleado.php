<?php

    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj= new crud();

    $datos=array(
        
        $_POST['nombre'],
        $_POST['multiplex'],
        $_POST['salario'],
        $_POST['cod'],
        $_POST['tipo'],
        $_POST['correo'],
        $_POST['fecha']

    );

    echo $obj->agregarEmpleado($datos);

?>