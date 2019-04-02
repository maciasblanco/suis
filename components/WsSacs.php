<?php
namespace app\components;
 
use Yii;
use yii\base\BaseObject;
 
class WsSacs extends BaseObject
{
	public $cliente=NULL;
	public $_salt = 'p4s$w5$4c$';
	public $rutaWsdl = 'http://10.29.2.107/ws_sacs/ws_sacs.wsdl';

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
		  	$this->cliente = null;
            return $this->catchError($e);
		}
	}

	/**
	 * Atrapa el error
	 */
	public function catchError($e){
        /*echo '<br/>Codigo: '.$e->getCode();
        echo '<br/>Archivo: '.$e->getFile();
        echo '<br/>Linea: '.$e->getLine();
        echo '<br/>Mensaje: '.$e->getMessage();*/
        return false;
    }

    /**
     * Recibe el numero de medicos registrados
     */
    public function cantMed()
    {
        try {
            if ($this->cliente == null) {
                return null;
            }
            
            $res = $this->cliente->cantMed($this->_salt);
            return $res;
        } catch (\SoapFault $e) {
            return $this->catchError($e);
        }
    }

    /**
     * Obtiene un lote de medicos
     */
    public function consultarMed($offset, $limit)
    {
        try {
            if ($this->cliente == null) {
                return null;
            }

            $res = $this->cliente->consultarMed($this->_salt, $offset, $limit);
            return $res;
        } catch (\SoapFault $e) {
            return $this->catchError($e);
        }
    }

    /**
     * Recibe el numero de enfermeras registradas
     */
    public function cantEnfer()
    {
        try {
            if ($this->cliente == null) {
                return null;
            }
            
            $res = $this->cliente->cantEnfer($this->_salt);
            return $res;
        } catch (\SoapFault $e) {
            return $this->catchError($e);
        }
    }

    /**
     * Obtiene un lote de enfermeras
     */
    public function consultarEnfer($offset, $limit)
    {
        try {
            if ($this->cliente == null) {
                return null;
            }

            $res = $this->cliente->consultarEnfer($this->_salt, $offset, $limit);
            return $res;
        } catch (\SoapFault $e) {
            return $this->catchError($e);
        }
    }
}