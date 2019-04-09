<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 */
class CircunferenciaCefalica extends Model {
	public $id;
	public $descripcion;

	const NORMAL = 1;
	const MICROCEFALICA = 2;
	const MACROCEFALIA = 3;

	/**
	 *
	 */
	public function getOptions($object = false)
	{
		$opc = [
			self::NORMAL => 'Normal',
			self::MICROCEFALICA => 'Microcefalica',
			self::MACROCEFALIA => 'Macrocefalia',
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

        $opc[] = new CircunferenciaCefalica([
            'id' => self::NORMAL,
            'descripcion' => 'Normal'
        ]);

        $opc[] = new CircunferenciaCefalica([
            'id' => self::MICROCEFALICA,
            'descripcion' => 'Microcefalica'
        ]);

        $opc[] = new CircunferenciaCefalica([
            'id' => self::MACROCEFALIA,
            'descripcion' => 'Macrocefalia'
        ]);

        return $opc;
    }

    /**
     *
     */
    public function getByIds($ids)
    {
        if (!is_array($ids) || empty($ids)) {
            return false;
        }

        $options = self::getOptions();
        $result = [];

        foreach ($options as $id => $value) {
            if (in_array($id, $ids) && !isset($result[$id])) {
                $result[$id] = new CircunferenciaCefalica([
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