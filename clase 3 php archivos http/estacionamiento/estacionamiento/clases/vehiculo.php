<?php

class Vehiculo{

    private $_patente;
    private $_horaIngreso;

    public function __construct($patente,$hora){

        $this->_patente = $patente;
        $this->_horaIngreso = $hora;

    }

    public function Estacionar(){

        // que no este estacionado
        $archivo=fopen("archivos/estacionados.txt", "a");//escribe y mantiene la informacion existente			
		$renglon=$this->getpatente()."=>".$this->_horaIngreso . "\n";
		fwrite($archivo, $renglon); 		 
        fclose($archivo);
        
        return true // ?
    }

    public function getpatente(){return $this->_patente;}

    public function Sacar($patente){
        $lista = Vehiculo::TraerTodos();

        foreach ($lista as $key => $value) {
            
            if($value->getpatente() === $patente)
            {
			
				$inicio=$value->;	
				$ahora=date("Y-m-d H:i:s"); 			 
 				$diferencia = strtotime($ahora)- strtotime($inicio) ;
 				//http://www.w3schools.com/php/func_date_strtotime.asp
 				$importe=$diferencia*15;
				$mensaje= "tiempo transcurrido:".$diferencia." segundos <br> costo $importe ";
				
				$archivo=fopen("archivos/facturacion.txt", "a"); 		  
		 		$dato=$patente ."=> $".$importe."\n" ;
		 		fwrite($archivo, $dato);
		 		fclose($archivo);            }
        }
    }

    // ??
    public static function TraerTodos(){
        $ListaDeAutosLeida=   array();
		$archivo=fopen("archivos/estacionados.txt", "r");//escribe y mantiene la informacion existente

			
		while(!feof($archivo))
		{
			$renglon=fgets($archivo);
			//http://www.w3schools.com/php/func_filesystem_fgets.asp
            $auto=explode("=>", $renglon);
            
            //http://www.w3schools.com/php/func_string_explode.asp
            
            //crear vehiculos a partir de lo que hay en el archivo
            $auto[0]=trim($auto[0]);
            $veh = new Vehiculo($auto[0],$auto[1]);
			if($auto[0]!="")
				$ListaDeAutosLeida[]=$veh;
		}

		fclose($archivo);
		return $ListaDeAutosLeida;
    }

    public function GuardarTodos($listado){
        
    }
}



?>