<?php

class Helado{


// sabor y tipo son id

//Andó el alta

// punto 8 y 9

// 10 y 11

private $sabor;
private $precio;
private $tipo;
private $cantidad;


public function __construct($unsabor,$untipo,$unprecio,$unacantidad){

    $this->sabor = $unsabor;
    $this->tipo = $untipo;
    $this->precio = $unprecio;
    $this->cantidad = (int)$unacantidad;


}

public function getsabor(){
    return $this->sabor;
}

public function setsabor($unsabor){
    $this->sabor = $unsabor;
}

public function gettipo(){
    return $this->tipo;
}

public function settipo($untipo){
    $this->tipo = $untipo;
}
public function getprecio(){
    return $this->precio;
}

public function setprecio($unprecio){
    $this->precio = $unprecio;
}
public function getcantidad(){
    return $this->cantidad;
}

public function setcantidad($uncantidad){
    $this->cantidad = $uncantidad;
}


// guardar archivo txt

public function Mostrar(){
    $salida = trim($this->getsabor()) . "-" . trim($this->gettipo())."-".trim($this->getprecio())."-".trim($this->getcantidad());
    return $salida;
}       

public static function GuardarHelado($unhelado){

    // base de datos

    $pdo = AccesoDatos::dameUnObjetoAcceso();

  // var_dump($pdo);

    /*
    				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cds (titel,interpret,jahr)values('$this->titulo','$this->cantante','$this->año')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
    
    */

//    var_dump($unhelado);

    $accion = $pdo->RetornarConsulta("INSERT into helados (sabor,precio,tipo,cantidad)values('".$unhelado->getsabor()."','".$unhelado->getprecio()."','".$unhelado->gettipo()."','".$unhelado->getcantidad()."')");

    $accion->execute();

    return $pdo->RetornarUltimoIdInsertado();
    /*$ar = fopen("Helados.txt", "a");
    
    
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar, $unhelado->Mostrar()."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		
    
    echo "Helado dado de alta";*/

}// fin 1

public static function TraerTodosLosHelados(){

    $ListaDeHeladosLeidos = array();
    //leo todos los usuarios del archivo
    $archivo=fopen("Helados.txt","r");
    
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
    fclose($archivo);
 
    return $ListaDeHeladosLeidos;

}


}



?>