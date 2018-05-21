<?php

class Tabla{

// get



// inscripciones realizadas

// la búsqueda por apellido no es del todo eficaz

public static function GenerarTabla($materia ="",$apellido = ""){

    echo "<table border='2px' solid>";
    echo "<caption>Resumen de inscripciones</caption>";
    echo "<thead>";    
    echo "<th>Nombre</th>"; 
    echo "<th>Apellido</th>"; 
    echo "<th>Correo electrónico</th>"; 
    echo "<th>Materia</th>"; 
    echo "<th>Código</th>"; 
    echo "</thead>";
    echo "<tbody>";

   
    $ones = Inscripcion::TraerTodasLasInscripciones();


    // inscripciones encontradas
    $onesencontrados = array();
    
    if(trim($materia)!=""||trim($apellido)!="")
    {
        if(trim($materia)!=""&&trim($apellido)!=""){
        
            $nombref = "";
            $emailf = "";
            $codigof = "";

            foreach ($ones as $key => $value) {
             
                if(trim($materia)==trim($value->getmateria())&&trim($apellido)==trim($value->getapellido())){
                 
                    $nombref = $value->getnombre();
                    $emailf = $value->getemail();
                    $codigof = $value->getcodigo();
                   
                    $onesencontrados[] = new Inscripcion($nombref,$apellido,$emailf,$materia,$codigof);                                  
                    break;
                    
                }

            }


        //    echo "los dos";
        }else {            

            if(trim($materia)!=""){
          //      echo "materia";

          $nombref = "";
          $emailf = "";
          $codigof = "";
          $apellidof = "";

          foreach ($ones as $key => $value) {
           
              if(trim($materia)==trim($value->getmateria())){
               
                  $nombref = $value->getnombre();
                  $emailf = $value->getemail();
                  $codigof = $value->getcodigo();
                  $apellidof = $value->getapellido();

                  $onesencontrados[] = new Inscripcion($nombref,$apellidof,$emailf,$materia,$codigof);                                  
                  
                  
              }

          }


            }

            if(trim($apellido)!=""){

    //             echo "apellido";

            $nombref = "";
          $emailf = "";
          $codigof = "";
          $materiaf = "";

          foreach ($ones as $key => $value) {
           
              if(trim($apellido)==trim($value->getapellido())){
               
                  $nombref = $value->getnombre();
                  $emailf = $value->getemail();
                  $codigof = $value->getcodigo();
                  $materiaf = $value->getmateria();

                  $onesencontrados[] = new Inscripcion($nombref,$apellido,$emailf,$materiaf,$codigof);    
                  
              }

          }

            }

        } // &&

        // ||
    }else{      

       foreach ($ones as $key => $value) {

            $onesencontrados[] = $value;
       }

    }

    if(empty($onesencontrados) == True){

            echo "la busqueda no ha arrojado resultados útiles";
            return false;  

    }  

    // tabla Inscriptos
        
        foreach ($onesencontrados as $key => $value) {
            
           echo "<tr>";
            
            echo "<td >".$value->getnombre()."</td>";
            echo "<td >".$value->getapellido()."</td>";
            echo "<td >".$value->getemail()."</td>";
            echo "<td >".$value->getmateria()."</td>";
            echo "<td >".$value->getcodigo()."</td>";
                    
            echo "</tr>";          
         }

        echo "</tbody>";
        echo "</table>";

}

}

?>