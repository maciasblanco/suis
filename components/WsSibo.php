<?php
namespace app\components;
 
use Yii;
use yii\base\Object;
 
class WsSibo extends Object
{
  public $cliente=NULL;
  public $salt = 'p4s$w5514m3D_BuS$$';
  public $rutaWsdl = 'http://190.9.128.237/ws_bus_ss/bus_ss.wsdl';

  /**
   * Constructor
   */
  public function __construct($config=[]){
    //Inicializar

    //Llamar al constructor del padre
    parent::__construct($config);
  }

  /**
   * Inicializacion
   */
  public function init(){
    parent::init();

    ini_set('soap.wsdl_cache_enabled',0);
    ini_set('soap.wsdl_cache_ttl',0);
    ini_set('default_socket_timeout',600);

    //Inicializar parametros tras la configuracion
    try{
      $this->cliente = new \SoapClient($this->rutaWsdl, array('trace'=>1));
    } catch (\SoapFault $e){
      
    }
  }

  /**
    PRUEBAAAA
    CONSULTA LA CI EN EL WS DEL BUS_SS_SIAMED
   */
  public function consultarCi($ci){
    $res = $this->cliente->consultarCi($this->salt, $ci);
    var_dump($res);
  }
 
}