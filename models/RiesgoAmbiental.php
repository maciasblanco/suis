<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.riesgo_ambiental".
 *
 * @property int $id
 * @property string $descripcion
 * @property bool $eliminado
 */
class RiesgoAmbiental extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.riesgo_ambiental';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'eliminado'], 'default', 'value' => null],
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
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
