<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.situacion_conyugal".
 *
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property bool $eliminado
 *
 * @property SeccionIII[] $seccionIIIs
 */
class SituacionConyugal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.situacion_conyugal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'codigo', 'eliminado'], 'default', 'value' => null],
            [['eliminado'], 'boolean'],
            [['nombre'], 'string', 'max' => 300],
            [['codigo'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'codigo' => Yii::t('app', 'Codigo'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionIIIs()
    {
        return $this->hasMany(SeccionIII::className(), ['std_civil_id' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }
}
