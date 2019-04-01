<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.lugar_atencion".
 *
 * @property int $id
 * @property string $descripcion
 * @property bool $eliminado
 *
 * @property Epi10[] $epi10s
 */
class LugarAtencion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.lugar_atencion';
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
            [['descripcion'], 'unique'],
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
    public function getEpi10s()
    {
        return $this->hasMany(Epi10::className(), ['id_lugar_atencion' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
