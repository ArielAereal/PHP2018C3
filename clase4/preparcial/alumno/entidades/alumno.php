<?php
class Alumno{
    
    private $_legajo;
    private $_nombre;
    private $_foto;
    
    public function __construct($nombre,$legajo){
        $this->_legajo = $legajo;        
        $this->_nombre = $nombre;        
    }
    public function getlegajo(){return $this->_legajo;}   

    public function GetNombre(){
        return $this->_nombre;       
	}
	
	public function SetNombre($nombre){
		$this->_nombre = $nombre;
	}
    public function Equals($alumno){
        
            if($this->getlegajo()=== $alumno->getlegajo()){
                return true;
            }
        
        return false;
    }
                
    public function Mostrar(){
        $salida = $this->GetNombre() . "-" . $this->getlegajo()."-".$this->getfoto();
        return $salida;
    }   

    public function establecerFoto($foto)
    {
        $this->_foto = $foto;
    }

    public function getfoto(){
        return $this->_foto;
    }

    public static function Guardar($obj)
	{
        $resultado = FALSE;
        
        if(!file_exists("../archivos")){
            mkdir("../archivos");
        }

    $ar = fopen("../archivos/alumno.txt", "a");
		
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->Mostrar()."\r\n");
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
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
    
    public static function Eliminar($legajo)
	{
		if($legajo === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeAlumnosLeidos = Alumno::TraerTodosLosAlumnos();
		$ListaDeAlumnos = array();
		$imagenParaBorrar = NULL;		
		
        
        for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
			if($ListaDeAlumnosLeidos[$i]->getlegajo() == $legajo){//encontre el borrado, lo excluyo
				
				// copiar alumno a la lista de alumnos borrados
				$imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->getfoto());			

				if(!file_exists("../archivos/alumnos_borrados"))
				{
					mkdir("../archivos/alumnos_borrados");
				}

				$borra = fopen("../archivos/alumnos_borrados/alumno.txt","a");

				// no puse las comprobaciones de que anda no anda


				fwrite($borra, $ListaDeAlumnosLeidos[$i]->Mostrar()."\r\n");

				fclose($borra);

				if(!file_exists("../archivos/alumnos_borrados/fotos_eliminadas"))
				{
					mkdir("../archivos/alumnos_borrados/fotos_eliminadas");
				}
				
				$fechaoff = date("d_m_Y");

				// cortar el contenido de la extensión, pegar la fecha y luego la extension						

				$recorten = pathinfo("../archivos/fotos/".$imagenParaBorrar,PATHINFO_FILENAME);
				$recortee = pathinfo("../archivos/fotos/".$imagenParaBorrar,PATHINFO_EXTENSION);
				
			copy("../archivos/fotos/".$imagenParaBorrar,"../archivos/alumnos_borrados/fotos_eliminadas/".$recorten."_".$fechaoff.".".$recortee);

				continue;
			}
			$ListaDeAlumnos[$i] = $ListaDeAlumnosLeidos[$i];
		}


		//var_dump($imagenParaBorrar);
        //BORRÓ LA IMAGEN ANTERIOR!!!!!!
		
		$tierra = getcwd();

		// Permission denied
		chdir("../archivos/fotos");

		chown($imagenParaBorrar,465);


		unlink($imagenParaBorrar);
		
		//ABRO EL ARCHIVO

		chdir($tierra);


		$ar = fopen("../archivos/alumno.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeAlumnos as $item){
			$cant = fwrite($ar, $item->Mostrar()."\r\n");
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		//CIERRO EL ARCHIVO
		fclose($ar);

		/*$limpieza = fopen("../archivos/alumno.txt", "r+");

		// un detalle las lineas en blanco, no afectan...
		while(!feof($ar)){

			str_replace(" ","",$ar); //para espacios en blanco

		}

		fclose($limpieza);*/
		
		return $resultado;
	}

	public static function Modificar($alumno){		

		if($alumno->getlegajo() === NULL)
			return FALSE;
			
		$resultado = TRUE;
				
		$ListaDeAlumnosLeidos = Alumno::TraerTodosLosAlumnos();
		$ListaDeAlumnos = array();
		$imagenParaModificar = NULL;		
		
        
        for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
			if($ListaDeAlumnosLeidos[$i]->getlegajo() == $alumno->getlegajo()){//encontre el modificable, lo modifico
				
				// copiar alumno a la lista de alumnos modificados
				$imagenParaModificar = trim($ListaDeAlumnosLeidos[$i]->getfoto());

		if(!file_exists("../archivos/alumnos_modificados"))
				{
					mkdir("../archivos/alumnos_modificados");
				}

				$modifica = fopen("../archivos/alumnos_modificados/alumno.txt","a");

				// no puse las comprobaciones de que anda no anda

				fwrite($modifica, $ListaDeAlumnosLeidos[$i]->Mostrar()."\r\n");

				fclose($modifica);

				if(!file_exists("../archivos/alumnos_modificados/fotos_modificadas"))
				{
					mkdir("../archivos/alumnos_modificados/fotos_modificadas");
				}
				
				$fechaoff = date("d_m_Y");

				// cortar el contenido de la extensión, pegar la fecha y luego la extension						

				$recorten = pathinfo("../archivos/fotos/".$imagenParaModificar,PATHINFO_FILENAME);
				$recortee = pathinfo("../archivos/fotos/".$imagenParaModificar,PATHINFO_EXTENSION);
				
			copy("../archivos/fotos/".$imagenParaModificar,"../archivos/alumnos_modificados/fotos_modificadas/".$recorten."_".$fechaoff.".".$recortee);

		//cómo lo encuentro si le modifico el legajo???

		//	$ListaDeAlumnosLeidos[$i]->setlegajo($alumno->getlegajo());

			$ListaDeAlumnosLeidos[$i]->setnombre($alumno->getnombre());
			$ListaDeAlumnosLeidos[$i]->establecerFoto($alumno->getfoto());

	}

	$ListaDeAlumnos[$i] = $ListaDeAlumnosLeidos[$i];
    //BORRÓ LA IMAGEN ANTERIOR!!!!!!
}

		$tierra = getcwd();

		// Permission denied
		chdir("../archivos/fotos");

		chown($imagenParaModificar,465);


		unlink($imagenParaModificar);
		
		//ABRO EL ARCHIVO

		chdir($tierra);


		$ar = fopen("../archivos/alumno.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeAlumnos as $item){
			$cant = fwrite($ar, $item->Mostrar()."\r\n");
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
}

}

?>