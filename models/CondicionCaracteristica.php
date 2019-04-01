<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.condicion_caracteristica".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property bool $eliminado
 *
 * @property CaracteristicaCondicionCaracteristica[] $caracteristicaCondicionCaracteristicas
 * @property Caracteristica[] $caracteristicas
 */
class CondicionCaracteristica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.condicion_caracteristica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'eliminado'], 'default', 'value' => null],
            [['codigo', 'nombre'], 'required'],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 4],
            [['nombre'], 'string', 'max' => 50],
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
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaracteristicaCondicionCaracteristicas()
    {
        return $this->hasMany(CaracteristicaCondicionCaracteristica::className(), ['id_condicion_caracteristica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaracteristicas()
    {
        return $this->hasMany(Caracteristica::className(), ['id' => 'id_caracteristica'])->viaTable('caracteristica_condicion_caracteristica', ['id_condicion_caracteristica' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }
}
