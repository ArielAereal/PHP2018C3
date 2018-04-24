<?php

class Usuario{

    private $nombre;
    private $email;
    private $perfil;
    private $edad;
    private $clave;

    public function __construct($unnombre,$unemail,$unperfil,$unaedad,$unaclave){

        $this->nombre = $unnombre;
        $this->email = $unemail;
        $this->perfil = $unperfil;
        $this->edad = $unaedad;
        $this->clave = $unaclave;

    }

    public function getnombre(){
        return $this->nombre;
    }

    public function setnombre($elnombre){
        $this->nombre = $elnombre;
    }

    public function getemail(){
        return $this->email;
    }

    public function setemail($elemail){
        $this->email = $elemail;
    }
    public function getperfil(){
        return $this->perfil;
    }

    public function setperfil($elperfil){
        $this->perfil = $elperfil;
    }
    public function getedad(){
        return $this->edad;
    }

    public function setedad($eledad){
        $this->edad = $eledad;
    }
    public function getclave(){
        return $this->clave;
    }

    public function setclave($elclave){
        $this->clave = $elclave;
    }

    public function Mostrar(){
        $salida = $this->getnombre() . "-" . $this->getemail()."-".$this->getperfil()."-".$this->getedad()."-".$this->getclave();
        return $salida;
    }   

    public static function Guardar($obj)
	{
       // $resultado = FALSE;
        
        if(!file_exists("/archivos")){
            mkdir("/archivos");
        }

    $ar = fopen("/archivos/alumno.txt", "a");
		
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->Mostrar()."\r\n");		
	
		//CIERRO EL ARCHIVO
		fclose($ar);		
		
    }

    public static function TraerTodosLosAlumnos()
	{

		$ListaDeAlumnosLeidos = array();

		//leo todos los productos del archivo
		$archivo=fopen("../archivos/alumno.txt","r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$alumnos = explode("-", $archAux);
			
			//	var_dump($alumnos);
			//no se...
			//array_pop($alumnos);
			

            $nombre;
            $legajo;
            $foto;
			$move = 0;
            foreach ($alumnos as $key => $value) {
				if($move == 0){
					$nombre = $value;
					$move++;
				}else if($move== 1){

					$legajo = $value;
					$move++;
				}else if($move == 2){

					$foto = $value;
					$move=0;
				}
            }
			
			$elalumno = new Alumno($nombre,$legajo);
			$elalumno->establecerFoto($foto);

			// hace que el último objeto vacío no entre en la lista
			$alumnos[0] = trim($alumnos[0]);

			if($alumnos[0] != ""){
						
				$ListaDeAlumnosLeidos[] = $elalumno;
			}
		}
		fclose($archivo);
				
		return $ListaDeAlumnosLeidos;
		
    }


}


?>