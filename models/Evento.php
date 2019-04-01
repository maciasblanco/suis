<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.personal_salud".
 *
 * @property int $id
 * @property int $cedula
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property int $id_sexo
 * @property string $fecha_nac
 * @property int $licencia
 * @property int $tipo_personal 1 => Medico, 2 => Enfermera
 *
 * @property Sexo $sexo
 * @property Epi10[] $epi10s
 * @property Epi10[] $epi10s0
 */
class Evento extends GrupoEpi12
{
	const TIPO = parent::EVENTO;

	/**
     * @return \yii\db\ActiveQuery
     */
    public static function find()
    {
        return (new EventoQuery(get_called_class()))->where(['tipo' => self::TIPO]);
    }
}