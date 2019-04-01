<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.semana_epidemiologica".
 *
 * @property int $id
 * @property int $anio
 * @property int $semana
 * @property string $fecha_ini
 * @property string $fecha_fin
 * @property bool $eliminado
 */
class SemanaEpidemiologica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.semana_epidemiologica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anio', 'semana', 'fecha_ini', 'fecha_fin', 'eliminado'], 'default', 'value' => null],
            [['anio', 'semana', 'fecha_ini', 'fecha_fin'], 'required'],
            [['anio', 'semana'], 'integer'],
            [['fecha_ini', 'fecha_fin'], 'safe'],
            [['eliminado'], 'boolean'],
            [['anio', 'semana'], 'unique', 'targetAttribute' => ['anio', 'semana']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'anio' => Yii::t('app', 'Año'),
            'semana' => Yii::t('app', 'Semana'),
            'fecha_ini' => Yii::t('app', 'Fecha de Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha de Fin'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpi10s()
    {
        return $this->hasMany(Epi10::className(), ['id_semana_epidemiologica' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->semana;
    }

    /**
     * @return string # de semana, fecha inicio y fecha fin
     */
    public function getSemanaYFechas()
    {
        return '#' . $this->semana . ': ' . $this->fecha_ini . ' - ' . $this->fecha_fin;
    }

    /**
     * Arregla el formato de la fecha
     */
    public function afterFind()
    {
        parent::afterFind();

        if (!empty($this->fecha_ini)) {
            $this->fecha_ini = date('d-m-Y', strtotime($this->fecha_ini));
        }

        if (!empty($this->fecha_fin)) {
            $this->fecha_fin = date('d-m-Y', strtotime($this->fecha_fin));
        }
    }
}
