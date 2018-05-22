<?php

class ListaClLoc{

public static function ListarLocalidades($lalocalidad){


    echo "<table border='2px' solid>";
    
        echo "<caption>Filtrar Clientes por localidad $lalocalidad </caption>";
    
        echo "<thead>";
    
        echo "<th>Localidad</th>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Foto</th>";
        
        echo "</thead>";
    
        echo "<tbody>";
    $lista = Cliente::TraerTodosLosClientes();

    foreach ($lista as $key => $value) {
        
        if(trim($value->getlocalidad()) == trim($lalocalidad)){


        //listado
        echo "<tr>";

        echo "<th>".$value->getlocalidad()."</th>";
        echo "<th>".$value->getid()."</th>";
        echo "<th>".$value->getnombre()."</th>";
            
                              
                    echo "<td><img heigth='200px' width='200px' src= 'ImagenesDeClientes/".$value->getfoto() . "' alt='noimghela.mig'></td>";

                    echo "</tr>";

                }
            }

        }//metodo


    }//clase


?>