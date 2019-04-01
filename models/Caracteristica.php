<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.caracteristica".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int $id_tipo_caracteristica
 * @property int $id_unidad_medida
 * @property bool $eliminado
 *
 * @property TipoCaracteristica $tipoCaracteristica
 * @property UnidadMedida $unidadMedida
 * @property CaracteristicaCondicionCaracteristica[] $caracteristicaCondicionCaracteristicas
 * @property CondicionCaracteristica[] $condicionCaracteristicas
 */
class Caracteristica extends \yii\db\ActiveRecord
{
  public $lis_condicion_caracteristica;
  public $arreglo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.caracteristica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'id_tipo_caracteristica', 'id_unidad_medida', 'eliminado'], 'default', 'value' => null],
            [['codigo', 'nombre', 'id_tipo_caracteristica', 'id_unidad_medida'], 'required'],
            [['id_tipo_caracteristica', 'id_unidad_medida'], 'integer'],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 6],
            [['nombre'], 'string', 'max' => 150],
            [['arreglo'], 'each', 'rule' => ['exist', 'skipOnError' => true, 'targetClass' => CondicionCaracteristica::className(), 'targetAttribute' => 'id']],
            [['id_tipo_caracteristica'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCaracteristica::className(), 'targetAttribute' => ['id_tipo_caracteristica' => 'id']],
            [['id_unidad_medida'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['id_unidad_medida' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codigo' => Yii::t('app', 'Codigo'),
            'nombre' => Yii::t('app', 'Nombre'),
            'id_tipo_caracteristica' => Yii::t('app', 'Tipo de Caracteristica'),
            'id_unidad_medida' => Yii::t('app', 'Unidad de Medida'),
            'eliminado' => Yii::t('app', 'Eliminado'),
            'arreglo' => Yii::t('app', 'Condicion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCaracteristica()
    {
        return $this->hasOne(TipoCaracteristica::className(), ['id' => 'id_tipo_caracteristica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'id_unidad_medida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaracteristicaCondicionCaracteristicas()
    {
        return $this->hasMany(CaracteristicaCondicionCaracteristica::className(), ['id_caracteristica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionCaracteristicas()
    {
        return $this->hasMany(CondicionCaracteristica::className(), ['id' => 'id_condicion_caracteristica'])->viaTable('caracteristica_condicion_caracteristica', ['id_caracteristica' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }

    public function afterFind(){
    parent::afterFind();
    if (!empty($this->caracteristicaCondicionCaracteristicas)) {
        foreach ($this->caracteristicaCondicionCaracteristicas as $valor) {
            $this->arreglo[] = $valor->id_condicion_caracteristica;
        }
      }
    }
}
