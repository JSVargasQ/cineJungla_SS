<?php 

include_once 'db.php';


class Usuario extends DB{

	private $nombre;
	private $user;
	private $cod_multiplex;
	private $tipo_usuario;
	private $cod_usuario;
	private $nom_t_usuario;
	private $nom_mul;


	public function existe($user,$pass){
		$md5pass =md5($pass);
		$query = $this->connect()->prepare('SELECT * FROM USUARIO WHERE USER_USUARIO = :user AND CLAVE_USUARIO=:pass');
		$query->execute(['user'=>$user,'pass'=>$md5pass]);

		if ($query->rowCount()){
			return true;

		}else{
			return false;
		}

	}

	public function setUser($user){
		$query=$this->connect()->prepare('SELECT nombre_empleado, EMPLEADO.cod_multiplex, cod_usuario, EMPLEADO.COD_TIPO_EMPLEADO, nombre_cargo_empleado, MULTIPLEX.nom_multiplex FROM EMPLEADO, CARGO_EMPLEADO, MULTIPLEX  WHERE cod_usuario=:user and EMPLEADO.cod_tipo_empleado = CARGO_EMPLEADO.cod_tipo_empleado and EMPLEADO.cod_multiplex = MULTIPLEX.cod_multiplex;');
		$query->execute(['user'=>$user]);

		foreach ($query as $currentuser) {
			$this->nombre=$currentuser['nombre_empleado'];
			$this->cod_multiplex=$currentuser['cod_multiplex'];
			$this->cod_usuario=$currentuser['cod_usuario'];
			$this->tipo_usuario=$currentuser["COD_TIPO_EMPLEADO"];
			$this->nom_t_usuario=$currentuser["nombre_cargo_empleado"];
			$this->nom_mul=$currentuser["nom_multiplex"];
		}
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	public function getCodigoMul(){
		return $this->cod_multiplex;
	}
		public function getTipoUsuario(){
		return $this->tipo_usuario;
	}
	
	public function getCodUsuario(){
	    return $this->cod_usuario;
	}
	
	public function getNomTUsuario(){
	    return $this->nom_t_usuario;
	}

	public function getNomMul(){
	    return $this->nom_mul;
	}
}





 ?>