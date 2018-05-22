<?php

/*include "entidades/cargarAlumno.php";

include "entidades/consultarAlumno.php";

include "entidades/cargarMateria.php";

include "entidades/inscribirAlumno.php";

include "entidades/inscripciones.php";

include "entidades/alumnos.php";

include "entidades/modificarAlumno.php";*/

//echo "Bienvenido a Alumno-Materia <br>";

$elcasoG = isset($_GET['caso']) ? $_GET['caso'] : NULL;

$elcasoP = isset($_POST['caso']) ? $_POST['caso'] : NULL;

//GET

if($elcasoG != NULL){

    switch ($elcasoG) {

        case 'consultarAlumno':

      //OK  echo "consulta ". $_GET['apellido'];  

      $back = consultaAlumno::Consultar($_GET['apellido']);

      if( $back != false) {

        foreach ($back as $key => $value) {
            echo $value->Mostrar(). "<br><br>";
        }

      }else{
        echo "No existe alumno con apellido: ".$_GET['apellido'];
      }
      

        break;

        case 'inscribirAlumno':

        // echo "inscribe alumnos";

         
        if(consultaAlumno::Consultar($_GET['apellido'])!= false){

            // las materias vienen cargadas en un combo box perfecto

        $prueba = new Inscripcion($_GET['nombre'],$_GET['apellido'],$_GET['email'],$_GET['materia'],$_GET['codigo']);

        Inscripcion::Guardar($prueba);

        //prueba 2 traer todos ok

       /* echo "<pre>";
        var_dump(Materia::TraerTodasLasMaterias());
        echo "</pre>";*/
        }else {

            echo "<br><br> Alumno no registrado, consultar en extensión universitaria";
        }
        
        break;        

        case 'inscripciones':

        //echo "tabla de inscripciones hechas";       
    
            if(isset($_GET['apellido'])){
            
                if(isset($_GET['materia']))
                {
                    Tabla::GenerarTabla($_GET['materia'],$_GET['apellido']);            
        
                }else{
                Tabla::GenerarTabla("",$_GET['apellido']);        
        
                }
            
            }else{
                if(isset($_GET['materia']))
                {
                    Tabla::GenerarTabla($_GET['materia']);     
                }else {
                    
                    Tabla::GenerarTabla();
                }
            
            }

            break;            
    
        case 'alumnos':

        TablaAlumnos::GenerarTabla();


    
        break;            

        default:

            echo "fatal error, get not found";


   
        break;
}

}
//POST

if($elcasoP != NULL){
    
    switch ($elcasoP) {

        case 'cargarAlumno':

        //echo "La carga de un alumno";

        // transformar la imagen file tmp en path de foto alojada en el servidor

        // primera prueba ok
        
        $prueba = new Alumno($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_FILES['foto']);

        /*echo "<pre>";
        var_dump($prueba);
        echo "</pre>";*/

        Alumno::Guardar($prueba);

        //prueba 2 traer todos ok:

      /*  echo "<pre>";
        var_dump(Alumno::TraerTodosLosAlumnos());
        echo "</pre>";*/
        
        break;

        case 'cargarMateria':

        //echo "Carga de Materias";

        // primera prueba ok
        
        $prueba = new Materia($_POST['nombre'],$_POST['codigo'],$_POST['cupo'],$_POST['aula']);

       /* echo "<pre>";
        var_dump($prueba);
        echo "</pre>";*/

        Materia::Guardar($prueba);

        //prueba 2 traer todos ok

        /*echo "<pre>";
        var_dump(Materia::TraerTodasLasMaterias());
        echo "</pre>";*/
        
        break;    

        case 'modificarAlumno':        

            $bandera = 0;

            // de todo a nada

        if (isset($_POST['nombre'])|| isset($_POST['apellido'])||isset($_FILES['foto'])){        

            if(isset($_POST['nombre'])&& isset($_POST['apellido'])&&isset($_FILES['foto'])){

                Modificacion::ModificarAlumno($_POST['email'],$_POST['nombre'],$_POST['apellido'],$_FILES['foto']);

                $bandera++;

            }else if($bandera == 0){
                // dos de tres

                if(isset($_POST['nombre'])&& isset($_POST['apellido'])){

                    Modificacion::ModificarAlumno($_POST['email'],$_POST['nombre'],$_POST['apellido']);
    
                    $bandera++;
                }
                if(isset($_POST['nombre'])&&isset($_FILES['foto'])){

                    Modificacion::ModificarAlumno($_POST['email'],$_POST['nombre'],"",$_FILES['foto']);
    
                    $bandera++;

                }

                if(isset($_POST['apellido'])&&isset($_FILES['foto'])){

                    Modificacion::ModificarAlumno($_POST['email'],"",$_POST['apellido'],$_FILES['foto']);
    
                    $bandera++;
                }

            }
            
            if($bandera == 0){

                // uno de tres

                if(isset($_POST['nombre'])){

                    Modificacion::ModificarAlumno($_POST['email'],$_POST['nombre']);
    
                   
                }
                if(isset($_FILES['foto'])){

                    Modificacion::ModificarAlumno($_POST['email'],"","",$_FILES['foto']);
                      

                }

                if(isset($_POST['apellido'])){

                    Modificacion::ModificarAlumno($_POST['email'],"",$_POST['apellido']);    
                    
                }

            }
            
        
        }else{
            echo "ingrese parámetro a modificar, bien";
        }
        break;        
    
        default:

        echo "fatal error, post not found";
        
        break;
}

}

?>