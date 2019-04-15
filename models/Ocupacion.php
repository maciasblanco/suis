<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.ocupacion".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property integer $padre
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class Ocupacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.ocupacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre'], 'required'],
            [['padre'], 'integer'],
            [['codigo'], 'string', 'max' => 15],
            [['nombre'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'padre' => 'Padre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['id_ocupacion' => 'id']);
    }

    public function getNombreCompleto()
    {
        return implode(' ', [
            $this->codigo,
            $this->nombre
        ]);
    }
}
