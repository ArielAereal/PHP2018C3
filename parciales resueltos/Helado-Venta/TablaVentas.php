<?php

class Tabla{

// get


// imagen email sabor y cantidad tipo
public static function GenerarTabla($email ="",$sabor = ""){

    echo "<table border='2px' solid>";
    echo "<caption>Resumen de ventas</caption>";
    echo "<thead>";
    echo "<th>Imágen</th>";
    echo "<th>EMAIL</th>"; // email
    echo "<th>Sabor</th>"; // sabor
    echo "<th>Tipo</th>"; // tipo
    echo "<th>Cantidad</th>"; // cantidad
    echo "</thead>";
    echo "<tbody>";
   
    $sales = VentaImagen::TraerTodasLasVentas();
    $reosencontrados = array();
    
    if($email!=""){
        
        $tipof = "";        
        $cantidadf = "";
        $imagenf = "";
        $animal = 0;

        if($sabor!= ""){

                // con tutti
                     
                foreach ($sales as $key => $value) {

                    if(trim($email)==trim($value->getemail())&&trim($sabor)==trim($value->getsabor())){
                 
                        $tipof = $value->gettipo();
                        $cantidadf = $value->getcantidad();
                                if($value instanceof VentaImagen){
                                    $imagenf = $value->getimagen();

                                    $reosencontrados[] = new VentaImagen($email,$sabor,$tipof,$cantidadf,$imagenf);
                                }else {

                                    $reosencontrados[] = new Venta($email,$sabor,$tipof,$cantidadf);

                                }                        
                        $animal++;
                        
                    }
                    
                }        

                if($animal == 0)
                {
                    echo $email . "-" . $sabor . " no corresponden"; 
                    return false; 
                }




            }   // $sabor;
    
            else{

                $saborf = "";

                foreach ($sales as $key => $value) {

                    if(trim($email)==trim($value->getemail())){
                 
                        $saborf = $value->getsabor();
                        $tipof = $value->gettipo();
                        $cantidadf = $value->getcantidad();
                                if($value instanceof VentaImagen){
                                    $imagenf = $value->getimagen();

                                    $reosencontrados[] = new VentaImagen($email,$saborf,$tipof,$cantidadf,$imagenf);
                                }else {

                                    $reosencontrados[] = new Venta($email,$saborf,$tipof,$cantidadf);

                                }                        
                        $animal++;
                        
                    }
                    
                }
        
                if($animal == 0)
                {
                    echo $email . " no corresponde";   
                     return false; 
                }

            }
            
            
            //$email; 
        }else if($sabor!="") {
            $emailf = "";
            $tipof = "";        
            $cantidadf = "";
            $imagenf = "";

            $animal = 0;
                
    
            foreach ($sales as $key => $value) {
    
            if(trim($sabor)==trim($value->getsabor())){
                     
                $emailf = $value->getemail();
                $tipof = $value->gettipo();
                $cantidadf = $value->getcantidad();

                if($value instanceof VentaImagen){

                    $imagenf = $value->getimagen();

                    $reosencontrados[] = new VentaImagen($emailf,$sabor,$tipof,$cantidadf,$imagenf);
                }else {
    
                    $reosencontrados[] = new Venta($emailf,$sabor,$tipof,$cantidadf);
                        }                        

                            $animal++;
                            
                        }
                        
                    }
            
                    if($animal == 0)
                    {
                        echo $sabor . " no corresponde"; 
                        return false; 
                    }
    
    
    
                    // $sabor solito;
    
                } else{
                    foreach ($sales as $key => $value) {
                        
                        $reosencontrados[] = $value;
                    }
                } // fin
        

        // tabla Ventas               
        
        foreach ($reosencontrados as $key => $value) {
            
           echo "<tr >";
        
          if($value instanceof VentaImagen){
                    
            echo "<td ><img height = '200px' width='200px' src='ImagenesDeLaVenta/".$value->getimagen()."' alt='imagensale.punk'></td>";            
                        }else {
                            echo "<td ><img height = '200px' width='200px' src='ImagenesDeLaVenta/#' alt='imagensale.punk'></td>";    
                        }

                        echo "<td >".$value->getemail()."</td>";
                        echo "<td >".$value->getsabor()."</td>";
                                             
                        echo "<td >".$value->gettipo()."</td>";
                        echo "<td >".$value->getcantidad()."</td>";
                    
                        echo "</tr>";          
         }

        echo "</tbody>";
        echo "</table>";

}

}

?>