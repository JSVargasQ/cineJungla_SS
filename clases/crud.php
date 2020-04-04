<?php 

	class crud{

		public function agregarFuncion($datos){
		
			$obj = new conectar();
			$conexion = $obj -> conexion();

			$fecha = $datos[3] . " " . $datos[4];

			$sql = "CALL INGRESAR_FUNCIONES($datos[0],$datos[1],$datos[2],'$fecha')";

			return mysqli_query($conexion, $sql);
		}

		public function agregarEmpleado($datos){

			$obj=new conectar();
			$conexion=$obj->conexion();

			$fecha = $datos[6] . " 00:00:00";


			$p = "NULL,'" .$datos[0]. "'," .$datos[1]. ",'".$fecha. "'," .$datos[2]. "," .$datos[3]. "," .$datos[4]. ",'" .$datos[5]. "',ACTIVO";
			
			$sql = "INSERT INTO TEST VALUES('".$datos[4]."')";
			mysqli_query($conexion, $sql);
			$sql = "INSERT INTO TEST VALUES('".$datos[5]."')";
			mysqli_query($conexion, $sql);
			$sql = "INSERT INTO TEST VALUES('".$datos[6]."')";
			mysqli_query($conexion, $sql);


			$sql = "INSERT INTO EMPLEADO VALUES(NULL,'".$datos[0]."',".$datos[1].",'".$fecha."',".$datos[2].",".$datos[3].",".$datos[4].",'".$datos[5]."','ACTIVO')";

			return mysqli_query($conexion, $sql);

		}


	}


 ?>