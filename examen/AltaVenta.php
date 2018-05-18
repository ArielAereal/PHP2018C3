<?php

class Venta{

private $sabor;
private $email;
private $tipo;
private $cantidad;

public function __construct($unemail,$unsabor,$untipo,$unacantidad){

    $this->sabor = $unsabor;
    $this->tipo = $untipo;
    $this->email = $unemail;
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
public function getemail(){
    return $this->email;
}

public function setemail($unemail){
    $this->email = $unemail;
}
public function getcantidad(){
    return $this->cantidad;
}

public function setcantidad($uncantidad){
    $this->cantidad = $uncantidad;
}

public static function TraerTodasLasVentas(){

    $ListaDeVentasLeidas = array();
    //leo todos las ventas del archivo
    $archivo=fopen("Venta.txt","r");
    
    while(!feof($archivo))
    {
        $archAux = fgets($archivo);
        $ventas = explode("-",$archAux);
           
       /* echo "<pre>";
        var_dump($ventas);
        echo "<pre>";*/

        $email = "";// ventas [0]
      $sabor ="";// ventas[1]
      $tipo ="";// ventas[2]
      $cantidad = "";// ventas [3]      
      
      // hace que el último objeto vacío no entre en la lista
      if(trim($ventas[0])!= ""){
          $email = $ventas[0];
        $sabor = $ventas[1];
        $tipo = $ventas[2];
        $cantidad = $ventas[3];
          
          $laventa = new Venta($email,$sabor,$tipo,$cantidad);
                    
          $ListaDeVentasLeidas[] = $laventa;
        }
        
    }
    fclose($archivo);
 
    return $ListaDeVentasLeidas;
}

public static function Laventa($email,$sabor,$tipo,$cantidad){

$flag = 0;
    
    $rta = ConsultaHelado::Consultar($tipo,$sabor);
    if( $rta == "Coincide $sabor y $tipo")
    {
        // helados con imagen
        $hela = HeladoModificado::TraerTodosLosHelados();

    foreach ($hela as $key => $value) {
        if(trim($value->getsabor()) == $sabor){
            if($cantidad > $value->getcantidad())
            {
                echo "no hay suficiente en stock";
                return false;
            }else
            {
                $dato = $value->getcantidad() - $cantidad;
                $value->setcantidad($dato);
                $flag = 1;
                break;
            }
        }
    } 
}else {
    echo "helado fuera de termino";
    return false;
   }    
        
    // actualizar txt helados
  
       $ar = fopen("helados.txt", "w");
				
        //ESCRIBO EN EL ARCHIVO
        
        foreach ($hela as $key => $value) {
            
            fwrite($ar, $value->Mostrar()."\r\n");		
        }
	
		//CIERRO EL ARCHIVO
        fclose($ar);


    
// si existe el helado, y hay stock, guardar en el archivo

if($flag == 1)
{
    // construir la linea y guardar en un array
    $todo = $email . "-" . $sabor . "-".$tipo."-".$cantidad;
    Venta::Guarda($todo);
}

} // cierra Laventa

public static function Guarda($todo){

    $ar = fopen("Venta.txt", "a");
        
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar, $todo."\r\n");		

    //CIERRO EL ARCHIVO
    fclose($ar);		
    
    echo "Venta dada de alta";
}

}

?>