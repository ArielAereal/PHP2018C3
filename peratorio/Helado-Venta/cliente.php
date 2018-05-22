<?php

class Cliente{

// sabor y tipo son id

private $id;
private $nombre;
private $localidad;
private $foto;


public function __construct($unid,$unalocalidad,$unnombre,$unafoto){

    $this->id = $unid;
    $this->localidad = $unalocalidad;
    $this->nombre = $unnombre;

    $this->foto = $this->depurarimagen($unafoto);
    
}

public function depurarimagen($lafototmp){
    
    
                
            if(!file_exists("ImagenesDeClientes")){
                mkdir("ImagenesDeClientes");
            }         
    
            if( !(gettype($lafototmp)=== "string")){
                
    
                $archivoTmp = $this->getid() . "+".$this->getnombre().".". pathinfo(trim($lafototmp["name"]),PATHINFO_EXTENSION);
        
                $destino = "ImagenesDeClientes/" . $archivoTmp;
            
                //$esImagen = getimagesize($image["tmp_name"]);           
             
                // trim trim trim
                if (!move_uploaded_file(trim($lafototmp["tmp_name"]), $destino)) {
                    echo "subida mala, el alumno se queda sin foto de perfil.";
                    return false;
                }else{
    
                    return $archivoTmp;
    
                }
    
            }else{
    
                return $lafototmp;
    
            }
    
        }// depurar

        public function getfoto(){
            return $this->foto;
        }
    
        public function setfoto($lafoto){
            $this->foto = $lafoto;
        }

public function getid(){
    return $this->id;
}

public function setid($unid){
    $this->id = $unid;
}

public function getlocalidad(){
    return $this->localidad;
}

public function setlocalidad($unalocalidad){
    $this->localidad = $unalocalidad;
}
public function getnombre(){
    return $this->nombre;
}

public function setnombre($unnombre){
    $this->nombre = $unnombre;
}

// guardar archivo txt

public function Mostrar(){
    $salida = trim($this->getid()) . "-" . trim($this->getnombre())."-".trim($this->getlocalidad())."-".trim($this->getfoto());
    return $salida;
}       

public static function GuardarCliente($uncliente){

    $ar = fopen("clientes.txt", "a");
        
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar, $uncliente->Mostrar()."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		
    
    echo "Cliente dado de alta";

}


public static function TraerTodosLosClientes(){

    $ListaDeClientesLeidos = array();
    //leo todos los clientes del archivo
    $archivo=fopen("clientes.txt","r");
    
    while(!feof($archivo))
    {
        $archAux = fgets($archivo);
        $clientes = explode("-",$archAux);
                       
      $id ="";// clientes[0]
      $nombre ="";// clientes[1]
      $localidad = "";// clientes [2]      
      $foto = "";// clientes [3]      

      

      // hace que el último objeto vacío no entre en la lista
      if(trim($clientes[0])!= ""){
        $id = $clientes[0];
        $nombre = $clientes[1];
        $localidad = $clientes[2];
        $foto = $clientes[3];        
        
        $elcliente = new Cliente($id,$nombre,$localidad,$foto);
            $ListaDeClientesLeidos[] = $elcliente;
                   
        }
        
    }
    fclose($archivo);
 
    return $ListaDeClientesLeidos;
}


}



?>