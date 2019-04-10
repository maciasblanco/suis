<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.conducta".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property bool $eliminado
 *
 * @property Conducta[] $conductas
 * @property RenglonConducta[] $renglonConductas
 */
class Conducta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.conducta';
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
            [['nombre'], 'string', 'max' => 150],
            [['codigo'], 'unique'],
            [['nombre'], 'unique'],
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
    public function getConductas()
    {
        return $this->hasMany(Conducta::className(), ['id_conducta' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenglonConductas()
    {
        return $this->hasMany(RenglonConducta::className(), ['hconducta' => 'id']);
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
