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
		    
			$aux = "select cantidad from cantidad_almacen where cantidad_almacen.codigo_producto=".$datos[0];
			$result=mysqli_query($conexion,$aux);
			$auxNum = mysqli_fetch_array($result);

			$newVal = intval($auxNum[0]) + intval($datos[1]);
			$sql = "UPDATE cantidad_almacen set cantidad =".$newVal." where cantidad_almacen.codigo_producto =".$datos[0];
			
		    return mysqli_query($conexion, $sql);
		}

		public function obtenerDatosFuncion($pCodFuncion, $pCodMultiplex){

			$obj = new conectar();
			$conexion=$obj->conexion();

			$sql= "	SELECT
						FUNCION.cod_funcion, SALA_CINE.nombre_sala, PELICULA.nombre_pelicula, PELICULA.duracion_pelicula,
						FUNCION.fecha_funcion, FUNCION.sillas_disponibles, FUNCION.estado_funcion
					FROM
						MULTIPLEX, FUNCION, PELICULA, SALA_CINE
					WHERE
						FUNCION.cod_pelicula = PELICULA.cod_pelicula AND
						FUNCION.cod_sala_cine = SALA_CINE.cod_sala_cine AND
						SALA_CINE.cod_multiplex = MULTIPLEX.cod_multiplex AND
						MULTIPLEX.cod_multiplex = $pCodMultiplex AND
						FUNCION.cod_funcion = $pCodFuncion" ;

					$result=mysqli_query($conexion, $sql);
					$ver=mysqli_fetch_row($result);

					$datos=array(
						'cod_funcion' => $ver[0], 
						'nombre_sala' => $ver[1], 
						'nombre_pelicula' => $ver[2], 
						'duracion_pelicula' => $ver[3],
						'fecha_funcion' => $ver[4], 
						'sillas_disponibles' => $ver[5], 
						'estado_funcion' => $ver[6]
					);
					return $datos;
		} 
	}
 ?>