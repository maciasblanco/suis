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
class Enfermera extends PersonalSalud
{
    const TIPO_PERSONAL = parent::ENFERMERA;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.personal_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules = array_merge($rules, [
            [['tipo_personal'], 'compare', 'compareValue' => self::TIPO_PERSONAL],
        ]);

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge($labels, []);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'id_sexo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpi10s()
    {
        return $this->hasMany(Epi10::className(), ['id_enfermera' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find()
    {
        return (new EnfermeraQuery(get_called_class()))->where(['tipo_personal' => self::TIPO_PERSONAL]);
    }
}
