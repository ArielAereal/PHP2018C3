<?php


// implementar una interfaz de imagen

// Hardcode, 3 de cada uno

// tema de resolver los ifs y yo uso bandera     

include "HeladoCarga.php";
include "ConsultarHelado.php";

include "AltaVenta.php";
include "AltaVentaConImagen.php";

include "TablaVentas.php";

include "HeladoModificacion.php";

include "BorrarHelado.php";

include "ListadoDeImagenes.php";


// bandera venta
// ?????
// como que no lo usé al final
$bvf = 0;

// listado de imagenes por POST
/*if(isset($_POST['listado'])){

    TablaImagenes::TablaImg($_GET['listado']);
}*/


// lo pruebo por get, para verlas
if(isset($_GET['listado'])){   

        TablaImagenes::TablaImg($_GET['listado']);

    }


// tabla
// imagen email sabor y cantidad tipo

if(isset($_GET['tabla'])){   
    
    if(isset($_GET['email'])){
    
        if(isset($_GET['Sabor']))
        {
            
            Tabla::GenerarTabla($_GET['email'],$_GET['Sabor']);            
        }else{
        Tabla::GenerarTabla($_GET['email']);        
    }
}else{
        if(isset($_GET['Sabor']))
        {
            Tabla::GenerarTabla("",$_GET['Sabor']);            
        }else{
            Tabla::GenerarTabla();
        }
    }

}

// carga helado
if(isset($_GET['Sabor']) && isset($_GET['Tipo']) && isset($_GET['precio'])&& isset($_GET['cantidad']))
{
Helado::GuardarHelado(new Helado($_GET['Sabor'],$_GET['Tipo'],$_GET['precio'],$_GET['cantidad']));
}


//POST


if(isset($_FILES['imagen'])){

    // modificacion sin email

    // no siempre viene una imagen
    $vienemail = isset($_POST['email']) ? $_POST['email'] : NULL;
    if($vienemail== NULL)
    {
        // que no genere una alta

     //   echo "imagen sin email, no es un alta sino una modificacion";
    }else{

        // alta venta imagen
        VentaImagen::LaVenta($_POST['email'],$_POST['Sabor'],$_POST['Tipo'],$_POST['cantidad'],$_FILES['imagen']);
        $bvf++;
    }

    }else if(isset($_POST['email'])){

        if(isset($_POST['Sabor'])&& isset($_POST['Tipo']) && isset($_POST['cantidad'])){    

            // alta venta
            Venta::Laventa($_POST['email'],$_POST['Sabor'],$_POST['Tipo'],$_POST['cantidad']);
            $bvf++;
        }

    }      

    //consultar helado
    // y modificar todo lo posible
    // y borrar

    if(isset($_POST['Sabor'])|| isset($_POST['Tipo'])){

    $vienesabor = isset($_POST['Sabor']) ? $_POST['Sabor'] : NULL;
    $vienetipo = isset($_POST['Tipo']) ? $_POST['Tipo'] : NULL;

    $back ="";
      
    if($vienesabor != NULL && $vienetipo != NULL)
    {    
        
        if(isset($_POST['borrar'])){

            if(ConsultaHelado::Consultar($vienetipo,$vienesabor) == "Coincide $vienesabor y $vienetipo"){             
            
                HeladoBorrado::Borrar($vienesabor,$vienetipo);
                //echo "borrar";
            }else{

                echo "Helado fuera de servicio o ya borrado";
            }
            
            
            // si viene con email no es modificacion
            // guarda con las ventas: 
        }else if(isset($_POST['email'])){
            
            // modifica precio cantidad imagen
        }else if (isset($_POST['precio'])|| isset($_POST['cantidad'])||isset($_FILES['imagen'])){
        
            $era = 0;
            if(ConsultaHelado::Consultar($vienetipo,$vienesabor) == "Coincide $vienesabor y $vienetipo"){             

                //todos

                if(isset($_FILES['imagen'])&& isset($_POST['precio'])&&isset($_POST['cantidad'])){

                    HeladoModificado::ModificarHelado($vienesabor,$vienetipo,$_FILES['imagen'],$_POST['precio'],$_POST['cantidad']);
                    $era++;
                }else{

                    // imagen y precio
                    if(isset($_FILES['imagen'])&& isset($_POST['precio'])){

                        HeladoModificado::ModificarHelado($vienesabor,$vienetipo,$_FILES['imagen'],$_POST['precio']);
                        $era++;
                    }

                    // imagen y cantidad
                    if(isset($_FILES['imagen'])&& isset($_POST['cantidad'])){

                        HeladoModificado::ModificarHelado($vienesabor,$vienetipo,$_FILES['imagen'],"",$_POST['cantidad']);
                        $era++;
                    }

                    // precio y cantidad
                    if(isset($_POST['cantidad'])&& isset($_POST['precio'])){

                        HeladoModificado::ModificarHelado($vienesabor,$vienetipo,"",$_POST['precio'],$_POST['cantidad']);
                        $era++;
                    }

                }
                // uno solo, *3
                if($era == 0){
                    if(isset($_FILES['imagen'])){

                        HeladoModificado::ModificarHelado($vienesabor,$vienetipo,$_FILES['imagen']);
                        
                    }

                    if(isset($_POST['precio'])){

                        HeladoModificado::ModificarHelado($vienesabor,$vienetipo,"",$_POST['precio']);
                        
                    }

                    if(isset($_POST['cantidad'])){

                        HeladoModificado::ModificarHelado($vienesabor,$vienetipo,"","",$_POST['cantidad']);                        
                    }

                }
                
                // fin modificacion total
            }else {
                echo ConsultaHelado::Consultar($vienetipo,$vienesabor);
                echo "imposible realizar la modificación";
            }
            
            
        }else{              
            //todos entran
           $back = ConsultaHelado::Consultar($vienetipo,$vienesabor);
        }

     
} else{

    if($vienesabor != NULL){
           
    //sabor solo
  $back =  ConsultaHelado::Consultar("",$vienesabor);
    
} else if($vienetipo != NULL){

    // tipo solo
  $back =  ConsultaHelado::Consultar($vienetipo);

}

}
    if($back != ""){

        echo $back;
    }

}// consultar helado

?>