<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 */
class Puerperio extends Model {
	public $id;
	public $descripcion;

	const INMEDIATO = 1;
	const MEDIATO = 2;

	/**
	 *
	 */
	public function getOptions($object = false)
	{
		$opc = [
			self::INMEDIATO => 'Inmediato < 24 horas',
			self::MEDIATO => 'Mediato < 40 días',
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

        $opc[] = new Puerperio([
            'id' => self::INMEDIATO,
            'descripcion' => 'Inmediato < 24 horas'
        ]);

        $opc[] = new Puerperio([
            'id' => self::MEDIATO,
            'descripcion' => 'Mediato < 40 días'
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
                $result[$id] = new Puerperio([
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