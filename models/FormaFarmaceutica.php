<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.forma_farmaceutica".
 *
 * @property int $id
 * @property string $descripcion
 * @property bool $eliminado
 *
 * @property Tratamiento[] $tratamientos
 */
class FormaFarmaceutica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.forma_farmaceutica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'eliminado'], 'default', 'value' => null],
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['eliminado'], 'boolean'],
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
    public function getTratamientos()
    {
        return $this->hasMany(Tratamiento::className(), ['id_forma_farmaceutica' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
