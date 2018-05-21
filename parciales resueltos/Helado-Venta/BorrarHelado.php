<?php

class HeladoBorrado extends HeladoModificado{

    public static function Borrar($unsabor,$untipo){

        //echo $unsabor . $untipo;
     
        // el helado a borrar
        $hecho;

        // la llave del helado en el array
        $point;


        $dero = HeladoModificado::TraerTodosLosHelados();

        foreach ($dero as $key => $value) {

            if(trim($value->getsabor()) == trim($unsabor) && trim($value->gettipo()) == trim($untipo)){

                $hecho = $value;
                break;
            }
        }

        if($hecho instanceof HeladoModificado){

             // si tiene foto, moverla a back up fotos...

             if(!file_exists("backUpFotos")){
                mkdir("backUpFotos");
            }
            $ext =  pathinfo('ImagenesDeHelados/'.$hecho->getimagen(),PATHINFO_EXTENSION);          

            $eras = date("Y_m_d_H_i_s") . "." . $ext;
            
            // TRIM TRIM TRIM y para eras tambien TRIM
            copy('ImagenesDeHelados/'. trim($hecho->getimagen()),'backUpFotos/'.trim($eras));


            // voy a borrar la foto, y a guardar los datos
            // de la foto borrada en un txt para luego
            // cargar el listado de imágenes borradas :P

            $ar = fopen("backUpFotos/info.txt", "a");
		
		    //ESCRIBO EN EL ARCHIVO
            fwrite($ar, $eras."\r\n");		
        
            //CIERRO EL ARCHIVO
            fclose($ar);		
            
            $tierra = getcwd();

		// Permission denied
		chdir("ImagenesDeHelados");

        chown(trim($hecho->getimagen()),465);
        
		unlink(trim($hecho->getimagen()));
		
		//ABRO EL ARCHIVO

		chdir($tierra);
        
        } else {
            echo "Helado sin imagen";
        }
        

        $point = array_search($hecho,$dero);

        array_splice($dero,$point,1);
             
        // actualizo el archivo helado
        $arch = fopen("Helados.txt", "w");        

        foreach ($dero as $key => $value) {
                        
            $todo = $value->Mostrar();
                       
            //ESCRIBO EN EL ARCHIVO
            fwrite($arch, $todo."\r\n");		
    
        }
        
        //CIERRO EL ARCHIVO
        fclose($arch);			    
    
        echo "Helado eliminado";

    }// Borrar

}

?>