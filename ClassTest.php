<?php
/**
 * Description of ClassTest
 * @access public
 * @package test
 * @author Angel Barrientos <uetiko@gmail.com>
 */
class ClassTest {
    public $variablePublica;
    protected $variableProtegida;
    private $variablePrivada;
    
    public function metodoPublico($variable){
        $this->variablePublica = $variable;
    }
    
    protected function metodoProtegido($variable){
        $this->variableProtegida = $variable;
    }
    
    private function metodoPrivado($variable){
        $this->variablePrivada= $variable;
    }
}

class ClaseStatica{
    public static $var = "variavke estatica";
    
    public static function metodoStatico(){
        return "metodo estaico";
    }
    
}

class Hijo extends ClassTest{
    /**
     * 
     * @param string $variable
     */
    function __construct($variable = NULL) {
        $this->metodoProtegido($variable);
    }
    
    public function metodohijoPublico(){
        return $this->variableProtegida;
    }
    
    public function __destruct() {
        echo "valio madres la clase";
    }
}

class Fea extends Hijo{
    public function escribeDato(){
        
    }
    
    public function metodohijoPublico(){
        return "fallo";
    }  
}

abstract class mamifero{
    public function __construct() {
        
    }
    
    public function caminando(){
        return "corriendo";
    }
}

interface mamiferoInterface{
    public function correr();
}


class Gato extends mamifero implements mamiferoInterface{
    private static $variable;
    public function __construct() {
        parent::__construct();
    }

        public function correr() {
            if(self::$variable instanceof Gato){
                return self::$variable;
            }else{
                return self::$variable = new Gato();
            }
        return "gato corre";
    }
}


class ConnectionMysql {
    private $host = NULL;
    private $usuario = NULL;
    private $password = NULL;
    private $base = NULL;
    private $port  = NULL;
    private $link  = NULL;
    public function __construct($host, $usuario, $password, $base, $port) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->base = $base;
        $this->port = $port;
    }
    
    public function openConnection(){
        if(!$this->link = mysql_connect($this->host, $this->usuario, $this->password)){
            throw new Exception(mysql_error());
        }elseif(!mysql_select_db($this->base, $this->link)){
            throw new Exception(mysql_error());
        }
    }
    
    protected function getLink(){
        return $this->link;
    }

    public function closeConnection(){
        if(!mysql_close($this->link)){
            throw new Exception(mysql_error());
        }
    }
    
    public function getQuery($select){
        $this->openConnection();
        return $this->getQueryResult(mysql_query($select, $this->getLink()));
    }

    private function getQueryResult($result){
        $r = array();
        $array = array();
        while ($row = mysql_fetch_assoc($result)) {
            $row;
            foreach ($row as $key => $value) {
                $array[$key] = $value;
            }
        }
        $this->closeConnection();
        return $array;
    }

}


class Singleton {
    private static $INSTANCE;
    private function __construct() {
        
    }
    
    public static function getInstance(){
        if(self::$INSTANCE instanceof Singleton){
            echo "clase ya instanciada\n";
            return self::$INSTANCE;
        }  else {
            echo "clase no instanciada\n";
            return self::$INSTANCE = new Singleton();
        }
    }
}

$obj = Singleton::getInstance();
$obj2 = Singleton::getInstance();
$obj3 = Singleton::getInstance();

$cnn = new ConnectionMysql('localhost', 'activismo', '*2FCCA5D7EFE1EBCA0DF15A87F2996F29F8C06728', 'activismoclick', '3306');
$select = "select id_usuario, usuario, password from tbl_usuario";
print_r($cnn->getQuery($select));
$select = "select * from tbl_usuario";
print_r($cnn->getQuery($select));
?>