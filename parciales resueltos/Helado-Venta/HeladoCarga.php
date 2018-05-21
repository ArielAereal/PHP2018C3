<?php

class Helado{

// sabor y tipo son id

private $sabor;
private $precio;
private $tipo;
private $cantidad;

public function __construct($unsabor,$untipo,$unprecio,$unacantidad){

    $this->sabor = $unsabor;
    $this->tipo = $untipo;
    $this->precio = (float)$unprecio;
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

    $ar = fopen("Helados.txt", "a");
        
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar, $unhelado->Mostrar()."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		
    
    echo "Helado dado de alta";

}// fin 1


// ahora hay helados con imagen, retoco la herencia de helado modificado
public static function TraerTodosLosHelados(){

    $ListaDeHeladosLeidos = array();
    //leo todos los helados del archivo
    $archivo=fopen("Helados.txt","r");
    
    while(!feof($archivo))
    {
        $archAux = fgets($archivo);
        $helados = explode("-",$archAux);
                       
      $sabor ="";// helados[0]
      $tipo ="";// helados[1]
      $precio = "";// helados [2]
      $cantidad = "";// helados [3]            

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