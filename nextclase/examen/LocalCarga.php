<?php

class Local{




//Andó el alta

// punto 8 y 9

// 10 y 

// tira warning con los argumentos del constructor

// revisar el metodo call

private $direccion;
private $idlocalidad;
private $estado;
private $id;


//ver
/*public function __call(,$args){
  
            
}*/

public function __construct($unadireccion="",$unidlocalidad="",$unestado=""){

    if($unadireccion!="")
    {
        $this->direccion = $unadireccion;

    }
    
    if($unidlocalidad!=""){

        $this->idlocalidad = $unidlocalidad;
    }
        

    if($unestado!=""){

        $this->estado = $unestado;
    }
   
}

public function getdireccion(){
    return $this->direccion;
}

public function setdireccion($undireccion){
    $this->direccion = $undireccion;
}

public function getidlocalidad(){
    return $this->idlocalidad;
}

public function setidlocalidad($unidlocalidad){
    $this->idlocalidad = $unidlocalidad;
}
public function getestado(){
    return $this->estado;
}

public function setestado($unestado){
    $this->estado = $unestado;
}

//duda

public function getid(){
    return $this->id;
}

public function setid($elid){
    $this->id = $elid;
}



public function Mostrar(){
    $salida = trim($this->getdireccion()) . "-" . trim($this->getidlocalidad())."-".trim($this->getestado());
    return $salida;
}       

public static function GuardarLocal($unlocal){

    // base de datos

    $pdo = AccesoDatos::dameUnObjetoAcceso();  

    /*
    				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cds (titel,interpret,jahr)values('$this->titulo','$this->cantante','$this->año')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
    
    */

//    var_dump($unlocal);

    $accion = $pdo->RetornarConsulta("INSERT into locales (direccion,idlocalidad,estado)values('".$unlocal->getdireccion()."','".$unlocal->getidlocalidad()."','".$unlocal->getestado()."')");

    $accion->execute();

    return $pdo->RetornarUltimoIdInsertado();
    /*$ar = fopen("Helados.txt", "a");
    
    
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar, $unhelado->Mostrar()."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		
    
    echo "Helado dado de alta";*/

}// fin 1



// hacer el traer todos los locales

public static function TraerTodosLosLocales(){

    $ListaDeLocalesLeidos = array();

    $auxs = array();


    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("select id,direccion as dir, idlocalidad as idloc,estado as est from locales");

  //$consulta =$objetoAccesoDato->RetornarConsulta("select id,direccion,idlocalidad,estado from locales");
    $consulta->execute();			
    $ListaDeLocalesLeidos =  $consulta->fetchAll(PDO::FETCH_CLASS, "Local");		


    foreach ($ListaDeLocalesLeidos as $key => $value) {
        
        $obj = new Local($value->dir,$value->idloc,$value->est);

        $obj->setid($value->id);

        $auxs[] = $obj;
        
    }

    //leo todos los usuarios del archivo
    /*$archivo=fopen("Helados.txt","r");
    
    while(!feof($archivo))
    {
        $archAux = fgets($archivo);
        $helados = explode("-",$archAux);
                       
      $sabor ="";// usuarios[0]
      $tipo ="";// usuarios[1]
      $precio = "";// usuarios [2]
      $cantidad = "";// usuarios [3]      
      
      // hace que el último objeto vacío no entre en la lista
      if(trim($helados[0])!= ""){
        $sabor = $helados[0];
        $tipo = $helados[1];
        $precio = $helados[2];
        $cantidad = $helados[3];
          
                
          $elhelado = new Helado($sabor,$tipo,$precio,$cantidad);
          
            
            
            $ListaDeHeladosLeidos[] = $elhelado;
        }
        
    }
    fclose($archivo);*/



 
    return $auxs;

}


}



?>