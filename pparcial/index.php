<?php

//pasa la clave por GET¡?¡?¡?¡?¡?¡?¿¿'¿'¿'¿'¿'¿'

include "VerificarUsuario.php";

include "AltaComentario.php";

include "AltaComentarioConImagen.php";

include "TablaComentarios.php";

include "UsuarioModificacion.php";

include "UsuarioModificacionValidado.php";

include "BorrarComentario.php";

include "ListadoDeImagenes.php";


//$queHago = isset($_GET['queHago']) ? $_GET['queHago'] : NULL;


// GET

// tabla comentarios

if(isset($_GET['tabla'])){   
    
    if(isset($_GET['nombre'])){
    
        if(isset($_GET['titulo']))
        {
            Tabla::GenerarTabla($_GET['nombre'],$_GET['titulo']);            

        }else{
        Tabla::GenerarTabla($_GET['nombre']);        

    }
}else{
        if(isset($_GET['titulo']))
        {
            Tabla::GenerarTabla("",$_GET['titulo']);            

        }else{
            Tabla::GenerarTabla();

        }
    }


} else {

// carga usuario

if(isset($_GET['email'])){

$intento = new Usuario($_GET['nombre'],$_GET['email'],$_GET['perfil'],$_GET['edad'],$_GET['clave']);

Usuario::Guardar($intento);

}
}

// POST

if(isset($_POST['email'])){

        // Alta comentario

        if (isset($_POST['titulo'])){

            if(isset($_FILES['imagen'])){
                ComentarioImagen::SubirComentario($_POST['email'],$_POST['titulo'],$_POST['comentario'],$_FILES['imagen']);
            }else {

                Comentario::SubirComentario($_POST['email'],$_POST['titulo'],$_POST['comentario']);
            }

        }else if(isset($_FILES['imagen']))
        {
            // ahora, si el usuario es admin, puede cambiar cualquier usuario

            // usuario modifica  

            // PROBADO Y FUNCIONANDO

            $params = 0;

            // 6 paramets
           
            if(isset($_POST['chemail'])){

                if(isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['nombre']) && isset($_POST['clave'])){                  
                    UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],$_POST['edad'],$_POST['clave'],$_POST['chemail']);
                    $params++;
                }    
            }else {

                if(isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['nombre']) && isset($_POST['clave'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],$_POST['edad'],$_POST['clave']);
                    $params++;
                }
            }


            // 5 paramets

            if($params == 0){     

                if(isset($_POST['chemail'])){

                    if(isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['nombre'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],$_POST['edad'],"",$_POST['chemail']);
                        $params++;
                    }

                    if(isset($_POST['perfil']) && isset($_POST['clave']) && isset($_POST['nombre'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],"",$_POST['clave'],$_POST['chemail']);
                        $params++;
                    }

                    if(isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['clave'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],$_POST['edad'],$_POST['clave'],$_POST['chemail']);
                        $params++;
                    }

                    if(isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['clave'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"",$_POST['edad'],$_POST['clave'],$_POST['chemail']);
                        $params++;
                    }

                }

            else {
           
                if(isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['nombre'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],$_POST['edad']);
                    $params++;
                }

                // Validado OK
                if(isset($_POST['perfil']) && isset($_POST['clave']) && isset($_POST['nombre'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],"",$_POST['clave']);
                    $params++;
                }

                // OK
                if(isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['clave'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"",$_POST['edad'],$_POST['clave']);
                    $params++;
                }

                // Validado OK
                if(isset($_POST['perfil']) && isset($_POST['edad']) && isset($_POST['clave'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],$_POST['edad'],$_POST['clave']);
                    $params++;
                }

            } // els uv

            } // 5 params


            // 4 parameters
            if($params == 0){

                if(isset($_POST['chemail'])){

                    if(isset($_POST['perfil']) && isset($_POST['edad'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],$_POST['edad'],"",$_POST['chemail']);
                        $params++;
                    }

                    if(isset($_POST['perfil']) && isset($_POST['clave'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],"",$_POST['clave'],$_POST['chemail']);
                        $params++;
                    }

                    if(isset($_POST['nombre']) && isset($_POST['perfil'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil'],"","",$_POST['chemail']);
                        $params++;
                    }

                    if(isset($_POST['edad']) && isset($_POST['clave'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","",$_POST['edad'],$_POST['clave'],$_POST['chemail']);
                        $params++;
                    }
    
                    if(isset($_POST['nombre']) && isset($_POST['clave'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"","",$_POST['clave'],$_POST['chemail']);
                        $params++;
                    }
    
                    if(isset($_POST['nombre']) && isset($_POST['edad'])){                  
                        UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"",$_POST['edad'],"",$_POST['chemail']);
                        $params++;
                    }

                } else {
              

                // Validado OK
                if(isset($_POST['perfil']) && isset($_POST['edad'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],$_POST['edad']);
                    $params++;
                }

                // Validado OK
                if(isset($_POST['perfil']) && isset($_POST['clave'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],"",$_POST['clave']);
                    $params++;
                }
                //OK
                if(isset($_POST['edad']) && isset($_POST['clave'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","",$_POST['edad'],$_POST['clave']);
                    $params++;
                }
                //OK
                if(isset($_POST['nombre']) && isset($_POST['clave'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"","",$_POST['clave']);
                    $params++;
                }
                //OK
                if(isset($_POST['nombre']) && isset($_POST['edad'])){                  
                    UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"",$_POST['edad']);
                    $params++;
                }

                // Validado OK

               if(isset($_POST['nombre']) && isset($_POST['perfil'])){                  
                UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],$_POST['perfil']);
                $params++;
            }
        } // else uv
            }

            // tres parámetros

            if($params == 0){

                if(isset($_POST['chemail'])){

                    if(isset($_POST['perfil'])){    
                    UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil'],"","",$_POST['chemail']);
                    $params++;
                }

                if(isset($_POST['clave'])){
                    UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","","",$_POST['clave'],$_POST['chemail']);
                    $params++;
                }
    
                if(isset($_POST['edad'])){
                    UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","",$_POST['edad'],"",$_POST['chemail']);
                    $params++;
                }

                if(isset($_POST['nombre'])){
                    UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre'],"","","",$_POST['chemail']);
                    $params++;
                }

             } else {
                

            if(isset($_POST['clave'])){
                UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","","",$_POST['clave']);
                $params++;
            }

            if(isset($_POST['edad'])){
                UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","",$_POST['edad']);
                $params++;
            }

            if(isset($_POST['perfil'])){

                // Validado OK
                UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],"",$_POST['perfil']);
                $params++;
            }


            if(isset($_POST['nombre'])){
                UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen'],$_POST['nombre']);
                $params++;
            }
        }// else uv
        }// fin 3 parametros
            
            if($params == 0){
               
                if(isset($_POST['chemail'])){
                    UsuarioValidado::ModificarUsuario($_POST['email'],$_FILES['imagen'],"","","","",$_POST['chemail']);
                } else {
                // validar dos parametros
                UsuarioMod::ModificarUsuario($_POST['email'],$_FILES['imagen']);
            }
            } // FIN USUARIO MODIFICADO VALIDADO
           
        
        // usuario valida clave

        } else if(isset($_POST['clave'])){

            Validar::Valida($_POST['email'],$_POST['clave']);

        } 

    else{

        echo "No hemos podido procesar su solicitud, intente más tarde.";
    }

} // POST email


// borro comment
if (isset($_POST['perfil'])&& isset($_POST['titulo'])){    
    ComentarioBorrado::Borrado($_POST['perfil'],$_POST['titulo']);
}



// va por post, pero por get las veo en el chrome
// limag admite cargadas o borradas
if(isset($_GET['limag']))
    TablaImagenes::TablaImg($_GET['limag']);

?>