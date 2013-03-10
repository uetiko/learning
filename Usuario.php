<?php
class Usuario {
    public $nombre;
    public $apellido;
    private $password;
    function __construct() {
        $this->nombre;
        $this->apellido;
        $this->password="Secreto";
    }
}

class cliente extends Usuario implements mostrar_presentacion{
    public function _construct(){
        parent::__construct();
    }
    public function presentacion(){
       $mensaje= "Nombre del usuario es ".$this->nombre." ".$this->apellido." y tiene un password que es ".$this->password;
       return $mensaje;
     }
}

interface mostrar_presentacion{
    public function presentacion();
}

$obj= new cliente();
$obj ->nombre="Luis";
$obj ->apellido="Peña";
echo $obj ->presentacion();
?>
