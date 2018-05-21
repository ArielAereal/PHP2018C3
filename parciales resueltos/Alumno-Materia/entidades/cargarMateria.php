<?php

// clase Alumno

class Materia{

    private $nombre;
    private $codigo;
    private $cupo;
    private $aula;

    
    public function __construct($unnombre,$uncodigo,$uncupo,$unaula){

        $this->nombre = $unnombre;
        $this->codigo = $uncodigo;
        $this->cupo = (int)$uncupo;        
        $this->aula = $unaula;
    }

    public function getnombre(){
        return $this->nombre;
    }

    public function setnombre($elnombre){
        $this->nombre = $elnombre;
    }

    public function getcupo(){
        return $this->cupo;
    }

    public function setcupo($elcupo){
        $this->cupo = $elcupo;
    }
    public function getcodigo(){
        return $this->codigo;
    }

    public function setcodigo($elcodigo){
        $this->codigo = $elcodigo;
    }
    public function getaula(){
        return $this->aula;
    }

    public function setaula($laaula){
        $this->aula = $laaula;
    }

    public function Mostrar(){
        $salida = trim($this->getnombre()) . "-" . trim($this->getcodigo())."-". trim($this->getcupo())."-".trim($this->getaula());
        return $salida;
    }   

    public static function Guardar($obj)
	{
         if(!file_exists("archivos")){
            mkdir("archivos");
        }

    $ar = fopen("archivos/materias.txt", "a");
		
		
		//ESCRIBO EN EL ARCHIVO
		fwrite($ar, $obj->Mostrar()."\r\n");		
	
		//CIERRO EL ARCHIVO
        fclose($ar);		
        
        echo "Materia dada de alta";
		
    }

    public static function TraerTodasLasMaterias()
	{
            
		$ListaDeMateriasLeidas = array();

        //leo todas las materias del archivo
        
		$archivo=fopen("archivos/materias.txt","r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$materias = explode("-",$archAux);
		                   
          $nombre ="";// materias[0]
          $codigo = "";// materias [1]
          $cupo ="";// materias[2]
          $aula = "";// materias [3]
                   
          
          // hace que el último objeto vacío no entre en la lista

          if($materias[0]!= ""){

            $nombre = $materias[0];
            $codigo = $materias[1];
            $cupo = $materias[2];
            $aula = $materias[3];
                       
            $lamateria = new Materia($nombre,$codigo,$cupo,$aula);

            $ListaDeMateriasLeidas[] = $lamateria;
            }
			
		}
		fclose($archivo);
     
		return $ListaDeMateriasLeidas;
		
    }// traer todos

}

?>