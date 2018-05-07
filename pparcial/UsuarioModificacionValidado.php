<?php

// UsuarioModificacionValidado.php: (por POST)se ingresarán todos los valores
// necesarios (incluida una imagen) para realizar los cambios en los datos del 
//usuario, si el usuario es admin puede hacer los cambios en cualquier usuario,
// de lo contrario solo puede cabiar los datos propios unicamente.

class UsuarioValidado extends UsuarioMod
{

    public static function ModificarUsuario ($unemail,$unaimagen = "",$unnombre="",$unperfil = "",$unaedad="",$unaclave="",$emailtar = ""){

        // verificar el perfil del email
        $profilo="";        

        // todos los usuarios
        $users = Usuario::TraerTodosLosUsuarios();

        // verificar el perfil del usuario ingresado con email

        foreach ($users as $key => $value) {
            
            if($unemail === trim($value->getemail())){               
               $profilo = trim($value->getperfil());
            }
        
        }
      

        if($profilo == "user"){
            parent::ModificarUsuario($unemail,$unaimagen,$unnombre,$unperfil,$unaedad,$unaclave);
        }else{
            if($profilo == "admin"){

                parent::ModificarUsuario($emailtar,$unaimagen,$unnombre,$unperfil,$unaedad,$unaclave);

            } //admin
        }// els user

    }



} // user validated




?>