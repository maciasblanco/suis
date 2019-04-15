<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.cie10_categoria".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $codigo
 * @property int $id_cie10_grupo
 * @property bool $eliminado
 *
 * @property Cie10Grupo $cie10Grupo
 * @property Cie10Subcategoria[] $cie10Subcategorias
 */
class Cie10Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.cie10_categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'codigo', 'id_cie10_grupo', 'eliminado'], 'default', 'value' => null],
            [['descripcion', 'codigo', 'id_cie10_grupo'], 'required'],
            [['descripcion'], 'string'],
            [['id_cie10_grupo'], 'integer'],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 7],
            [['id_cie10_grupo'], 'exist', 'skipOnError' => true, 'targetClass' => Cie10Grupo::className(), 'targetAttribute' => ['id_cie10_grupo' => 'id']],
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
            'id_cie10_grupo' => Yii::t('app', 'Id Cie10 Grupo'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Grupo()
    {
        return $this->hasOne(Cie10Grupo::className(), ['id' => 'id_cie10_grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Subcategorias()
    {
        return $this->hasMany(Cie10Subcategoria::className(), ['id_cie10_categoria' => 'id']);
    }
    /**
     * Codigo + Descripcion
     */
    public function getCodigoDescripcion()
    {
        if (empty($this->codigo)) {
            return $this->cie10Grupo->codigoDescripcion;
        } else {
            return implode(' - ', [$this->codigo, $this->descripcion]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return empty($this->descripcion) ? $this->cie10Grupo : $this->descripcion;
    }
}
