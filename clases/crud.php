<?php 

	class crud{

		public function agregarFuncion($datos){
		
			$obj = new conectar();
			$conexion = $obj -> conexion();

			$datos[2] = $datos[2]-1;

			$fecha = $datos[3] . " " . $datos[4];

			$sql = "CALL INGRESAR_FUNCIONES($datos[0],$datos[1],$datos[2],'$fecha')";

			$rta = mysqli_query($conexion, $sql);

			return $rta;
		}

		public function agregarEmpleado($datos){

			$obj=new conectar();
			$conexion=$obj->conexion();

			$fecha = $datos[6] . " 00:00:00";

			$sql = "INSERT INTO EMPLEADO VALUES(NULL,'".$datos[0]."',".$datos[1].",'".$fecha."',".$datos[2].",".$datos[3].",".$datos[4].",'".$datos[5]."','ACTIVO')";

			return mysqli_query($conexion, $sql);

		}

		public function agregarSnack($datos){
		    
		    $obj=new conectar();
		    $conexion=$obj->conexion();
		    
		    $aux = "select cantidad from cantidad_almacen where cantidad_almacen.producto = .$datos[0].;";
		    $sql = "UPDATE cantidad_almacen set cantidad = .$aux + $datos[1]. where cantidad_almacen.producto = .$datos[0].;";
		    
		    return mysqli_query($conexion, $sql);
		    
		}
	}


 ?>