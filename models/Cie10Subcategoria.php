<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.cie10_subcategoria".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $codigo
 * @property int $id_cie10_categoria
 * @property bool $eliminado
 *
 * @property Cie10Categoria $cie10Categoria
 * @property GrupoEpi12Cie10[] $grupoEpi12Cie10s
 * @property GrupoEpi12[] $grupoEpi12s
 */
class Cie10Subcategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.cie10_subcategoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'codigo', 'id_cie10_categoria', 'eliminado'], 'default', 'value' => null],
            [['descripcion', 'codigo', 'id_cie10_categoria'], 'required'],
            [['descripcion'], 'string'],
            [['id_cie10_categoria'], 'integer'],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 7],
            [['id_cie10_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Cie10Categoria::className(), 'targetAttribute' => ['id_cie10_categoria' => 'id']],
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
            'id_cie10_categoria' => Yii::t('app', 'Id Cie10 Categoria'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Categoria()
    {
        return $this->hasOne(Cie10Categoria::className(), ['id' => 'id_cie10_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEpi12Cie10s()
    {
        return $this->hasMany(GrupoEpi12Cie10::className(), ['id_cie10_subcategoria' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEpi12s()
    {
        return $this->hasMany(GrupoEpi12::className(), ['id' => 'id_grupo_epi12'])->viaTable('grupo_epi12_cie10', ['id_cie10_subcategoria' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpi10Diagnosticos()
    {
        return $this->hasMany(\app\modules\epi10\models\Diagnostico::className(), ['id_diagnostico' => 'id']);
    }

    /**
     * Codigo + Descripcion
     */
    public function getCodigoDescripcion()
    {
        if (empty($this->codigo)) {
            return $this->cie10Categoria->codigoDescripcion;
        } else {
            return implode(' - ', [$this->codigo, $this->descripcion]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return empty($this->descripcion) ? $this->cie10Categoria : $this->descripcion;
    }
}
