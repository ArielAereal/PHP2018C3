<?php

include "HeladoCarga.php";
include "ConsultarHelado.php";
include "AltaVenta.php";
include "AltaVentaConImagen.php";
include "TablaVentas.php";

$paso = 0;
// tabla

// imagen email sabor y cantidad tipo
if(isset($_GET['tabla'])){   
    
    if(isset($_GET['email'])){
    
        if(isset($_GET['sabor']))
        {
            Tabla::GenerarTabla($_GET['email'],$_GET['sabor']);            
        }else{
        Tabla::GenerarTabla($_GET['email']);        
    }
}else{
        if(isset($_GET['sabor']))
        {
            Tabla::GenerarTabla("",$_GET['sabor']);            
        }else{
            Tabla::GenerarTabla();
        }
    }

// alta venta imagen

if(isset($_FILES['imagen'])){

    VentaImagen::LaVenta($_POST['email'],$_POST['Sabor'],$_POST['Tipo'],$_POST['cantidad'],$_FILES['imagen']);
$paso++;
}


// carga helado
if(isset($_GET['Sabor']) && isset($_GET['Tipo']) && isset($_GET['precio'])&& isset($_GET['cantidad']))
{
Helado::GuardarHelado(new Helado($_GET['Sabor'],$_GET['Tipo'],$_GET['precio'],$_GET['cantidad']));
}

// alta venta

if($paso == 0){


if(isset($_POST['email'])){

    if(isset($_POST['Sabor'])&& isset($_POST['Tipo']) && isset($_POST['cantidad'])){    
        Venta::Laventa($_POST['email'],$_POST['Sabor'],$_POST['Tipo'],$_POST['cantidad']);
    }

}else {

//consultar helado

if(isset($_POST['Sabor'])|| isset($_POST['Tipo'])){

//ver para diferenciar el null

$vienesabor = isset($_POST['Sabor']) ? $_POST['Sabor'] : NULL;
$vienetipo = isset($_POST['Tipo']) ? $_POST['Tipo'] : NULL;
$flag = 0;
$back;

if($flag == 0){

        
    if($vienesabor != NULL)
    {
        if($vienetipo != NULL)
        {
                        
      $back = ConsultaHelado::Consultar($vienetipo,$vienesabor);
            //todos
       
           
                $flag = 2;
                
                
            }else{
                
           
      $back =  ConsultaHelado::Consultar("",$vienesabor);
        //sabor
        
        $flag++;
    

       

       
        }

        
    } else {
        
      $back =  ConsultaHelado::Consultar($vienetipo);


    }
    
}

echo $back;



}


}

}


?>