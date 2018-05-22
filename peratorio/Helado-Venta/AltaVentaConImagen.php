<?php

// altaventa guardar imagen

// nos reservamos los guiones medios para 
// el explode, para separar atributos en el txt

class VentaImagen extends Venta{

    private $imagen;

    public function __construct($unemail,$unsabor,$untipo,$unacantidad,$unid,$unaimagen){

        parent::__construct($unemail,$unsabor,$untipo,$unacantidad,$unid);

        $this->imagen = $unaimagen;

    }   

    public function getimagen(){
        return $this->imagen;
    }
    
    public function setimagen($unaimagen){
        $this->imagen = $unaimagen;
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
      $id = "" ;
      $imagen = ""; // ventas [4]   
      
      // hace que el último objeto vacío no entre en la lista
      if(trim($ventas[0])!= ""){
          $email = $ventas[0];
        $sabor = $ventas[1];
        $tipo = $ventas[2];
        $cantidad = $ventas[3];
        $id = $ventas[4];
        if(isset($ventas[5])){
            $imagen = $ventas[5];

            $laventa = new VentaImagen($email,$sabor,$tipo,$cantidad,$id,$imagen);  
            $ListaDeVentasLeidas[] = $laventa;
        } else{

            $laventa = new Venta($email,$sabor,$tipo,$cantidad,$id);
            $ListaDeVentasLeidas[] = $laventa;
        }
                    
        }
        
    }
    fclose($archivo);
 
    return $ListaDeVentasLeidas;
}

public static function LaVenta($email,$sabor,$tipo,$cantidad,$id,$imagen){

    $archivoTmp = "";
    if(!file_exists("ImagenesDeLaVenta")){
        mkdir("ImagenesDeLaVenta");
    }

    $flag = 0;
    
    $rta = ConsultaHelado::Consultar($tipo,$sabor);
    if( $rta == "Coincide $sabor y $tipo")
    {
        // helado con imagen
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
    
    // actualizar txt helados
    $ar = fopen("helados.txt", "w");
				
    //ESCRIBO EN EL ARCHIVO
    
    foreach ($hela as $key => $value) {
        
        fwrite($ar, $value->Mostrar()."\r\n");		
    }

    //CIERRO EL ARCHIVO
    fclose($ar);

}else {
    echo "helado fuera de termino";
    return false;
   }

if($flag == 1){

$fech = date("Y_m_d_H_i_s");
$archivoTmp = $sabor . "_".$fech.".". pathinfo($imagen["name"],PATHINFO_EXTENSION);
$destino = "ImagenesDeLaVenta/" . $archivoTmp;

if (!move_uploaded_file($imagen["tmp_name"], $destino)) {
    echo "subida mala";
    return false;
        }
    $todo = $email . "-" . $sabor . "-".$tipo."-".$cantidad . "-" .$id."-". $archivoTmp;
            Venta::Guarda($todo);

        }
 
}

}

?>