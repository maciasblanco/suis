<?php

namespace app\models;

use Yii;
use app\modules\epi10\models\DatosAtencion;

/**
 * This is the model class for table "catalogo.nivel_educativo".
 *
 * @property int $id
 * @property string $descripcion
 * @property bool $eliminado
 *
 * @property DatosAtencion[] $datosAtencions
 * @property DatosEducacion[] $datosEducacions
 */
class NivelEducativo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.nivel_educativo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'eliminado'], 'default', 'value' => null],
            [['descripcion'], 'required'],
            [['eliminado'], 'boolean'],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosAtencion()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_nivel_educativo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getDatosEducacions()
    {
        return $this->hasMany(DatosEducacion::className(), ['id_nivel_educativo' => 'id']);
    }*/
    
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
