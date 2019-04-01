<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.grupo_epi12".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $tipo 1 => Enfermedad, 2 => Evento
 * @property bool $eliminado
 * @property int $orden
 *
 * @property GrupoEpi12Cie10[] $grupoEpi12Cie10s
 * @property Cie10Subcategoria[] $cie10Subcategorias
 */
class GrupoEpi12 extends \yii\db\ActiveRecord
{
    const ENFERMEDAD = 1;
    const EVENTO = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.grupo_epi12';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'tipo', 'eliminado', 'orden'], 'default', 'value' => null],
            [['tipo', 'orden'], 'integer'],
            [['eliminado'], 'boolean'],
            [['descripcion'], 'string', 'max' => 100],
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
            'tipo' => Yii::t('app', 'Tipo'),
            'eliminado' => Yii::t('app', 'Eliminado'),
            'orden' => Yii::t('app', 'Orden'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEpi12Cie10s()
    {
        return $this->hasMany(GrupoEpi12Cie10::className(), ['id_grupo_epi12' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Subcategorias()
    {
        return $this->hasMany(Cie10Subcategoria::className(), ['id' => 'id_cie10_subcategoria'])->viaTable('grupo_epi12_cie10', ['id_grupo_epi12' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
