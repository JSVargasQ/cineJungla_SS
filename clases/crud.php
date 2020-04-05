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

		public function actualizarFuncion($datos){
		
			$obj = new conectar();
			$conexion = $obj -> conexion();

			mysqli_query($conexion, "INSERT INTO TEST VALUES('".$datos[0]."-".$datos[1]."-".$datos[2]."-".$datos[3]."-".$datos[4]."-".$datos[5]."')");

			$fecha = $datos[2]." ".$datos[3]; 

			$sql = "UPDATE
						FUNCION, SALA_CINE
					SET
						FUNCION.cod_sala_cine=".$datos[0]." AND
						FUNCION.cod_pelicula=".$datos[1]." AND
						FUNCION.fecha_funcion='".$fecha."'
						
					WHERE
						FUNCION.cod_sala_cine = SALA_CINE.cod_sala_cine AND
						SALA_CINE.cod_multiplex =".$datos[4]." AND FUNCION.cod_funcion=".$datos[5];

					mysqli_query($conexion, "INSERT INTO TEST VALUES('".$sql."')");

			return mysqli_query($conexion, $sql);
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
						SALA_CINE.cod_sala_cine, PELICULA.cod_pelicula, FUNCION.fecha_funcion, 
						FUNCION.cod_funcion, MULTIPLEX.cod_multiplex 
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

					$fecha = substr($ver[2], 0,10);
					$hora =  substr($ver[2], 11);

										
					$datos=array(
						'cod_sala' => $ver[0], 
						'cod_pelicula' => $ver[1], 
						'fecha' => $fecha, 
						'hora' => $hora,
						'multiplex' => $ver[3],
						'cod_funcion' => $ver[4]

					);

					return $datos;


		} 
	}


	


 ?>