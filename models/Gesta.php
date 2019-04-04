<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.gestas".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property DatosAtencion[] $datosAtencions
 */
class Gesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.gesta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosAtencions()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_gesta' => 'id']);
    }

    public function __toString()
    {
        return $this->descripcion;
    }
}
