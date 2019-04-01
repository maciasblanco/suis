<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.discapacidad".
 *
 * @property int $id
 * @property string $nombre
 * @property bool $eliminado
 *
 * @property DatosAtencion[] $datosAtencions
 */
class Discapacidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.discapacidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['nombre', 'eliminado'], 'default', 'value' => null],
            [['eliminado'], 'boolean'],
            [['nombre'], 'string', 'max' => 50],
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
            'nombre' => Yii::t('app', 'Nombre'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosAtencions()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_discapacidad' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }
}
