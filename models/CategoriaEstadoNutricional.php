<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.categoria_estado_nutricional".
 *
 * @property int $id
 * @property string $descripcion
<<<<<<< HEAD
 * @property bool $eliminado
=======
>>>>>>> modelosarreglos
 *
 * @property EstadoNutricional[] $estadoNutricionals
 */
class CategoriaEstadoNutricional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.categoria_estado_nutricional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eliminado'], 'default', 'value' => false],
            [['eliminado'], 'boolean'],
            [['descripcion'], 'default', 'value' => null],
            [['descripcion'], 'string'],
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
    public function getEstadoNutricionals()
    {
        return $this->hasMany(EstadoNutricional::className(), ['id_categoria_estado_nutricional' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
