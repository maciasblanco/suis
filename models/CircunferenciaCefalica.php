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
	public function __toString()
	{
		return $this->descripcion;
	}
}