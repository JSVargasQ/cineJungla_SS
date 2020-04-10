<?php

    require_once "../clases/conexion.php";
    require_once "../clases/A_crud.php";
    $obj= new A_crud();

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