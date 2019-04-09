<?php

namespace app\models;

use Yii;
use app\modules\epi10\models\DatosAtencion;

/**
 * This is the model class for table "catalogo.etnia".
 *
 * @property int $id
 * @property string $descripcion
 * @property bool $eliminado
 *
 * @property DatosAtencion[] $datosAtencions
 */
class Etnia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.etnia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'eliminado'], 'default', 'value' => null],
            [['eliminado'], 'boolean'],
            [['descripcion'], 'string', 'max' => 150],
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
        return $this->hasMany(DatosAtencion::className(), ['id_etnia' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
