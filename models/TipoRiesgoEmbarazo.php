<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 */
class TipoRiesgoEmbarazo extends Model {
	public $id;
	public $descripcion;

	const BAJO = 1;
	const ALTO = 2;

	/**
	 *
	 */
	public function getOptions($object = false)
	{
		$opc = [
			self::BAJO => 'Bajo Riesgo',
			self::ALTO => 'Alto Riesgo',
		];

		if ($object) {
			$opc = (object) $opc;
		}

		return $opc;
	}

    /**
     *
     */
    public function getAsRows()
    {
        $opc = [];

        $opc[] = new TipoRiesgoEmbarazo([
            'id' => self::BAJO,
            'descripcion' => 'Bajo Riesgo'
        ]);

        $opc[] = new TipoRiesgoEmbarazo([
            'id' => self::ALTO,
            'descripcion' => 'Alto Riesgo'
        ]);

        return $opc;
    }

    /**
     *
     */
    public function getByIds($ids)
    {
        if (!is_array($ids)) {
            return false;
        }

        $options = self::getOptions();
        $result = [];

        foreach ($options as $id => $value) {
            if (in_array($id, $ids) && !isset($result[$id])) {
                $result[$id] = new TipoRiesgoEmbarazo([
                    'id' => $id,
                    'descripcion' => $value,
                ]);
            }
        }

        return $result;
    }

	/**
	 *
	 */
	public function __toString()
	{
		return $this->descripcion;
	}
}