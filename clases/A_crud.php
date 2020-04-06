<?php 

include_once '../controlador/user.php';
include_once '../controlador/user_Sesion.php';

	class A_crud{
	    
	    private $cod_usuario;
	    private $nom_c_empleado;
	    private $ip;
	    
	    public function __construct()
	    {
	        $userSession = new UserSession();
	        $user = new Usuario();
	        $user->setUser($userSession->getCurrentUser());
	        $cod_usuario = $user->getCodUsuario();
	        $nom_c_empleado = $user->getNomTUsuario();
	        $host= gethostname();
	        $ip = gethostbyname($host);
	        $this->cod_usuario = $cod_usuario;
	        $this->nom_c_empleado = $nom_c_empleado;
	        $this->ip = $ip;
	    }
	    
	    public function agregarFuncion($datos)
		{
		    
			$obj = new conectar();
			$conexion = $obj -> conexion();

			$datos[2] = $datos[2]-1;

			$fecha = $datos[3] . " " . $datos[4];

			$sql = "CALL INGRESAR_FUNCIONES($datos[0],$datos[1],$datos[2],'$fecha')";
			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Create', 'Funciones', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;
		}

		public function actualizarFuncion($datos){
		
			$obj = new conectar();
			$conexion = $obj -> conexion();

			$fecha = $datos[2]." ".$datos[3]; 

			$sql = "UPDATE FUNCION, SALA_CINE
					
					SET
						FUNCION.cod_sala_cine=".$datos[0].",
						FUNCION.cod_pelicula=".$datos[1].",
						FUNCION.fecha_funcion='".$fecha."'
									
					WHERE
						FUNCION.cod_sala_cine = SALA_CINE.cod_sala_cine AND
						SALA_CINE.cod_multiplex=".$datos[5]." AND 
						FUNCION.cod_funcion=".$datos[4];

			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Update', 'Funciones', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;
		}

		public function agregarEmpleado($datos){

			$obj=new conectar();
			$conexion=$obj->conexion();

			$fecha = $datos[6] . " 00:00:00";

			$sql = "INSERT INTO EMPLEADO VALUES(NULL,'".$datos[0]."',".$datos[1].",'".$fecha."',".$datos[2].",".$datos[3].",".$datos[4].",'".$datos[5]."','ACTIVO')";
			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Create', 'Empleado', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;

		}

		public function agregarSnack($datos){
		    
		    $obj=new conectar();
		    $conexion=$obj->conexion();

			$aux = "select cantidad from cantidad_almacen where cantidad_almacen.codigo_producto=".$datos[0]." AND cantidad_almacen.multiplex='".$datos[3]."'";
			$result=mysqli_query($conexion,$aux);
			$auxNum = mysqli_fetch_array($result);

			$alm = intval($datos[1])-1;

			$newVal = intval($auxNum[0]) + intval($datos[2]);
			$sql = "UPDATE cantidad_almacen 
					set cantidad =".$newVal." 
					where 
						cantidad_almacen.codigo_producto=".$datos[0]." AND 
						cantidad_almacen.almacen=".$alm." AND 
						cantidad_almacen.multiplex='".$datos[3]."'" ;

			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Update', 'Snack', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
		    return $r;
		    
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





		public function obtenerDatosEmpleados($pCodEmpleado){

			$obj = new conectar();
			$conexion=$obj->conexion();

			$sql= 	"SELECT
						EMPLEADO.nombre_empleado, EMPLEADO.salario_empleado, EMPLEADO.cod_usuario,
						EMPLEADO.cod_tipo_empleado, EMPLEADO.correo_empleado, EMPLEADO.fecha_ingreso_empleado  
					FROM
						EMPLEADO
					WHERE
						EMPLEADO.cod_empleado =".$pCodEmpleado;

					$result=mysqli_query($conexion, $sql);
					$ver=mysqli_fetch_row($result);
										
					$datos=array(
						'nom_empleado' => $ver[0], 
						'salario_empleado' => $ver[1], 
						'cod_usuario' => $ver[2], 
						'cod_tipo_empleado' => $ver[3],
						'correo_empleado' => $ver[4],
						'fecha_ingreso' => substr($ver[5], 0,10),
						'cod_empleado' => $pCodEmpleado

					);

					return $datos;
		} 


		public function actualizarEmpleado($datos){
		
			$obj = new conectar();
			$conexion = $obj -> conexion();
			
			$fecha = $datos[4]." 00:00:00"; 

			$sql = "UPDATE 
							EMPLEADO
					SET
							nombre_empleado='".$datos[0]."',
							salario_empleado=".$datos[1].",
							cod_tipo_empleado=".$datos[2].",
							correo_empleado='".$datos[3]."',
							fecha_ingreso_empleado='".$fecha."'
					WHERE
							cod_empleado =".$datos[5] ;


			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Update', 'Empleado', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;
		}

		function deshabilitarEmpleado($pCodEmpleado){
			$obj = new conectar();
			$conexion = $obj -> conexion();
	
			$sql = "UPDATE EMPLEADO SET estado_empleado='INACTIVO' WHERE cod_empleado=".$pCodEmpleado;
	
			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Delete', 'Empleado', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;			
		}

		function habilitarEmpleado($pCodEmpleado){
			$obj = new conectar();
			$conexion = $obj -> conexion();
	
			$sql = "UPDATE EMPLEADO SET estado_empleado='ACTIVO' WHERE cod_empleado=".$pCodEmpleado;
			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Update', 'Empleado', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;
		}

		function eliminarFuncion($pCodFuncion, $pCodMultiplex){
			$obj = new conectar();
			$conexion = $obj -> conexion();

			$sql = "UPDATE FUNCION, SALA_CINE
					
					SET
						FUNCION.estado_funcion='NO DISPONIBLE'

					WHERE
						FUNCION.cod_sala_cine = SALA_CINE.cod_sala_cine AND
						SALA_CINE.cod_multiplex=".$pCodMultiplex." AND 
						FUNCION.cod_funcion=".$pCodFuncion;
			$r = mysqli_query($conexion, $sql);
			
			$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Delete', 'Funciones', now(),'".$this->ip."');";
			mysqli_query($conexion,$sql);
			
			return $r;
	}

	function deshabilitarSala($pCodSala, $pCodMultiplex){
		$obj = new conectar();
		$conexion = $obj -> conexion();

		$sql = "UPDATE SALA_CINE SET estado_sala='INACTIVO' WHERE cod_sala_cine=".$pCodSala." AND cod_multiplex=".$pCodMultiplex;
		$r = mysqli_query($conexion, $sql);
		
		$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Update', 'Salas', now(),'".$this->ip."');";
		mysqli_query($conexion,$sql);
		
		return $r;
	}

	function habilitarSala($pCodSala, $pCodMultiplex){
		$obj = new conectar();
		$conexion = $obj -> conexion();

		$sql = "UPDATE SALA_CINE SET estado_sala='ACTIVO' WHERE cod_sala_cine=".$pCodSala." AND cod_multiplex=".$pCodMultiplex;
		$r = mysqli_query($conexion, $sql);
		
		$sql = "insert into AUDITORIA (cod_usuario, nombre_cargo_empleado, accion, nombre_tabla, fecha_modificacion, ip_modificacion) values (".$this->cod_usuario.", '".$this->nom_c_empleado."', 'Update', 'Salas', now(),'".$this->ip."');";
		mysqli_query($conexion,$sql);
		
		return $r;		
	}
}
 ?>