<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.cie10_capitulo".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $codigo
 * @property bool $eliminado
 *
 * @property Cie10Grupo[] $cie10Grupos
 */
class Cie10Capitulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.cie10_capitulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'codigo', 'eliminado'], 'default', 'value' => null],
            [['descripcion', 'codigo'], 'required'],
            [['descripcion'], 'string'],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 7],
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
            'codigo' => Yii::t('app', 'Codigo'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Grupos()
    {
        return $this->hasMany(Cie10Grupo::className(), ['id_cie10_capitulo' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
