<?php


class TablaAlumnos
{

    // por post no las puedo ver

    // las probé por get y andan

    public static function GenerarTabla(){

        echo "<table border='2px' solid>";
        echo "<caption>Listado de Alumnos Veteranos</caption>";
        echo "<thead>";    
        echo "<th>Nombre</th>"; 
        echo "<th>Apellido</th>"; 
        echo "<th>Correo electrónico</th>"; 
        echo "<th>Foto</th>";         
        echo "</thead>";
        echo "<tbody>";

        $lista = Alumno::TraerTodosLosAlumnos();
        
          foreach ($lista as $key => $value) {            
            
            echo "<tr>";
             
             echo "<td >".$value->getnombre()."</td>";
             echo "<td >".$value->getapellido()."</td>";
             echo "<td >".$value->getemail()."</td>";
             
             //trim trim trim
             echo "<td ><img height='200px' width='200px'alt='fotofail.tmp'src='archivos/ImagenesDeAlumnos/".trim($value->getfoto())."'></img></td>";             
                     
             echo "</tr>";          
          }
 
         echo "</tbody>";
         echo "</table>";
    }    

}

?>