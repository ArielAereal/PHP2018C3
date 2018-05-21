<?php

// clase Materia

class Inscripcion{

    private $nombre;
    private $apellido;
    private $email; // id alumnos
    private $materia;
    private $codigo; // id materia

    
    public function __construct($unnombre,$unapellido,$unemail,$unamateria,$uncodigo){

        $this->nombre = $unnombre;
        $this->apellido = $unapellido;
        $this->email = $unemail;
        $this->materia = $unamateria;
        $this->codigo = $uncodigo;

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
    public function getapellido(){
        return $this->apellido;
    }

    public function setapellido($elapellido){
        $this->apellido = $elapellido;
    }

    public function getmateria(){
        return $this->materia;
    }

    public function setmateria($lamateria){
        $this->materia = $lamateria;
    }
    public function getcodigo(){
        return $this->codigo;
    }

    public function setcodigo($elcodigo){
        $this->codigo = $elcodigo;
    }

    public function Mostrar(){
        $salida = trim($this->getnombre()) . "-". trim($this->getapellido())."-". trim($this->getemail())."-". trim($this->getmateria())."-" . trim($this->getcodigo());
        return $salida;
    }   

    // interfaz guardar path y tipo de objeto (con metodo Mostrar)

    public static function Guardar($obj)
	{        

    $ar = fopen("archivos/inscripciones.txt", "a");
		
		
		//ESCRIBO EN EL ARCHIVO
		fwrite($ar, $obj->Mostrar()."\r\n");		
	
		//CIERRO EL ARCHIVO
        fclose($ar);		
        
        echo "Inscripción dada de alta";

        // a demás retoco el archivo de materias (cupo)
        Inscripcion::actualizarcupo($obj->getcodigo());        	
    }



    public static function TraerTodasLasInscripciones()
	{
        $ListaDeInscripcionesLeidas = array();

        //leo todas las inscripciones del archivo
        
		$archivo=fopen("archivos/inscripciones.txt","r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$inscripciones = explode("-",$archAux);
		                   
          $nombre ="";// inscripciones[0]
          $apellido= ""; // inscripciones[1]
          $email = ""; // inscripciones [2]
          $materia = ""; // inscripciones [3]
          $codigo = "";// inscripciones [4]         
                             
          // hace que el último objeto vacío no entre en la lista

          if($inscripciones[0]!= ""){

            $nombre = $inscripciones[0];
            $apellido = $inscripciones[1];
            $email = $inscripciones[2];
            $materia = $inscripciones[3];
            $codigo = $inscripciones[4];
            
                       
            $lainscripcion = new Inscripcion($nombre,$apellido,$email,$materia,$codigo);

            $ListaDeInscripcionesLeidas[] = $lainscripcion;
            }
			
		}
		fclose($archivo);
     
		return $ListaDeInscripcionesLeidas;
		
    }// traer todos

    public static function actualizarcupo($elcodigo){

        // abro materias, modifico el cupo de la elegida, 

        $distraido = Materia::TraerTodasLasMaterias();

        //1) variables necesarias

        // la materia a modificar
        $hecha;               

        // la llave de la materia a modificar
        $point;

        foreach ($distraido as $key => $value) {

            // el miedo del trim

            if(trim($value->getcodigo())== trim($elcodigo)){

                $hecha = $value;
                break;
            }


        }

        
        $listo = $hecha->getcupo() - 1 ;        

        $hecha->setcupo($listo);

        // 2) la llave de la materia a modificar

        $point = array_search($hecha,$distraido); 

        // 3) la modificacion del array
        array_splice($distraido,$point,1,array($hecha));

        // 4) actualizar el archivo de texto

        $ar = fopen("archivos/materias.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($distraido as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);


    }// actualizar cupo

}

?>