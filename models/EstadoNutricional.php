<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.estado_nutricional".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $id_categoria_estado_nutricional
 * @property bool $eliminado
 *
 * @property CategoriaEstadoNutricional $categoriaEstadoNutricional
 */
class EstadoNutricional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.estado_nutricional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_categoria_estado_nutricional', 'eliminado'], 'default', 'value' => null],
            [['descripcion', 'id_categoria_estado_nutricional'], 'required'],
            [['id_categoria_estado_nutricional'], 'integer'],
            [['eliminado'], 'boolean'],
            [['descripcion'], 'string', 'max' => 60],
            [['id_categoria_estado_nutricional'], 'exist', 'skipOnError' => true, 'targetClass' => CategoriaEstadoNutricional::className(), 'targetAttribute' => ['id_categoria_estado_nutricional' => 'id']],
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
            'id_categoria_estado_nutricional' => Yii::t('app', 'Categoria Estado Nutricional'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaEstadoNutricional()
    {
        return $this->hasOne(CategoriaEstadoNutricional::className(), ['id' => 'id_categoria_estado_nutricional']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
