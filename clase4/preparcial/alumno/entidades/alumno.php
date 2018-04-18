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
		$archivo=fopen("../archivos/alumno.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
            $alumnos = explode(" - ", $archAux);
            $nombre;
            $legajo;
            $foto;
            foreach ($alumnos as $key => $value) {
                if(!isset($nombre)){$nombre = $value;}
                if(!isset($legajo)){$legajo = $value;}
                if(!isset($foto)){$foto = $value;}
                            }
            
			$alumnos[0] = trim($alumnos[0]);
			if($alumnos[0] != ""){
                
				$ListaDeAlumnosLeidos[] = new Alumno($nombre, $legajo,$foto);
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
		$imagenParaBorrar= "Javier909.jpg";
		
        // revisar esto, hacerlo como a mi me parece para que funcione


        for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
			if($ListaDeAlumnosLeidos[$i]->getlegajo() == $legajo){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->getfoto());
				continue;
			}
			$ListaDeAlumnos[$i] = $ListaDeAlumnosLeidos[$i];
		}


		//var_dump($imagenParaBorrar);
        //BORRÓ LA IMAGEN ANTERIOR!!!!!!
        
		// Permission denied
		chdir("../archivos/fotos");

		chown($imagenParaBorrar,465);


		unlink($imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("../archivos/alumno.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeAlumnos as $item){
			$cant = fwrite($ar, $item->Mostrar());
			
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