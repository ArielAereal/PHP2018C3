<?php
class Alumno{
    
    private $_legajo;
    private $_nombre;
    private $_foto;
    
//ver la particularidad de la foto

    public function __construct($nombre,$legajo){
        $this->_legajo = $legajo;        
        $this->_nombre = $nombre;        
    }
    public function getlegajo(){return $this->_legajo;}   

    public function GetNombre(){
        return $this->_nombre;
        
    }
    public function Equals($alumno){
        if($this->GetNombre()===$alumno->GetNombre())
        {
            if($this->getlegajo()=== $alumno->getlegajo()){
                return true;
            }
        }
        return false;
    }
                
    public function Mostrar(){
        $salida = $this->GetNombre() . "-" . $this->getlegajo();
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
		$cant = fwrite($ar, $obj->Mostrar()."-".$obj->getfoto(). "\r\n");
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
    
}
?>