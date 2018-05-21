<?php

class ConsultaAlumno{

    public static function Consultar($unapellido){

        $curso = Alumno::TraerTodosLosAlumnos();

        $salen = array();

        

        foreach ($curso as $key => $value) {
            
            // hacerlo case insensitive

            if(strcasecmp(trim($unapellido),trim($value->getapellido())) == 0){

                $salen[] = $value;

            }
        }

        
        if(empty($salen) == FALSE){          

            return $salen;
        }else {
          
            return false;
        }


    }

}

?>