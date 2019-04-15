<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.cie10_grupo".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $codigo
 * @property int $id_cie10_capitulo
 * @property bool $eliminado
 *
 * @property Cie10Categoria[] $cie10Categorias
 * @property Cie10Capitulo $cie10Capitulo
 */
class Cie10Grupo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.cie10_grupo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'codigo', 'id_cie10_capitulo', 'eliminado'], 'default', 'value' => null],
            [['descripcion', 'codigo', 'id_cie10_capitulo'], 'required'],
            [['descripcion'], 'string'],
            [['id_cie10_capitulo'], 'integer'],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 7],
            [['id_cie10_capitulo'], 'exist', 'skipOnError' => true, 'targetClass' => Cie10Capitulo::className(), 'targetAttribute' => ['id_cie10_capitulo' => 'id']],
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
            'id_cie10_capitulo' => Yii::t('app', 'Id Cie10 Capitulo'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Categorias()
    {
        return $this->hasMany(Cie10Categoria::className(), ['id_cie10_grupo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Capitulo()
    {
        return $this->hasOne(Cie10Capitulo::className(), ['id' => 'id_cie10_capitulo']);
    }
    /**
     * Codigo + Descripcion
     */
    public function getCodigoDescripcion()
    {
        if (empty($this->codigo)) {
            return $this->cie10Capitulo->codigoDescripcion;
        } else {
            return implode(' - ', [$this->codigo, $this->descripcion]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return empty($this->descripcion) ? $this->cie10Capitulo : $this->descripcion;
    }
}
