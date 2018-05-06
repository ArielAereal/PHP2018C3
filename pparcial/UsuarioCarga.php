<?php



class Usuario{

    private $nombre;
    private $email;
    private $perfil;
    private $edad;
    private $clave;

    public function __construct($unnombre,$unemail,$unperfil,$unaedad,$unaclave){

        $this->nombre = $unnombre;
        $this->email = $unemail;
        $this->perfil = $unperfil;
        $this->edad = (int)$unaedad;
        $this->clave = $unaclave;

    }

    public function getnombre(){
        return $this->nombre;
    }

    public function setnombre($elnombre){
        $this->nombre = $elnombre;
    }

    public function getemail(){
        return $this->email;
    }

    public function setemail($elemail){
        $this->email = $elemail;
    }
    public function getperfil(){
        return $this->perfil;
    }

    public function setperfil($elperfil){
        $this->perfil = $elperfil;
    }
    public function getedad(){
        return $this->edad;
    }

    public function setedad($eledad){
        $this->edad = $eledad;
    }
    public function getclave(){
        return $this->clave;
    }

    public function setclave($elclave){
        $this->clave = $elclave;
    }

    public function Mostrar(){
        $salida = $this->getnombre() . "-" . $this->getemail()."-".$this->getperfil()."-".$this->getedad()."-".trim($this->getclave());
        return $salida;
    }   

    public static function Guardar($obj)
	{
         if(!file_exists("archivos")){
            mkdir("archivos");
        }

    $ar = fopen("archivos/usuarios.txt", "a");
		
		
		//ESCRIBO EN EL ARCHIVO
		fwrite($ar, $obj->Mostrar()."\r\n");		
	
		//CIERRO EL ARCHIVO
        fclose($ar);		
        
        echo "Usuario dado de alta";
		
    }

    public static function TraerTodosLosUsuarios()
	{
            
		$ListaDeUsuariosLeidos = array();

		//leo todos los usuarios del archivo
		$archivo=fopen("archivos/usuarios.txt","r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$usuarios = explode("-",$archAux);
		                   
          $nombre ="";// usuarios[0]
          $email ="";// usuarios[1]
          $perfil = "";// usuarios [2]
          $edad = "";// usuarios [3]
          $clave = "";// usuarios [4]
          $imagen =""; // usuarios [5]          
          

          // hace que el último objeto vacío no entre en la lista
          if($usuarios[0]!= ""){

            $nombre = $usuarios[0];
            $email = $usuarios[1];
            $perfil = $usuarios[2];
            $edad = $usuarios[3];
            $clave = $usuarios[4];
            
            if(isset($usuarios[5])){
                $imagen = $usuarios[5];
              }
                           
              
              if($imagen != ""){
                  $elusuario = new UsuarioMod($nombre,$email,$perfil,$edad,$clave,$imagen);
                }else{
                    
                    $elusuario = new Usuario($nombre,$email,$perfil,$edad,$clave);
                }
                
                
                $ListaDeUsuariosLeidos[] = $elusuario;
            }
			
		}
		fclose($archivo);
      /*      echo "<pre>";
        var_dump($ListaDeUsuariosLeidos);
        echo "</pre>";*/
		return $ListaDeUsuariosLeidos;
		
    }


}


?>