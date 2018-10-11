<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.profesion".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property string $nivel
 * @property integer $largo
 * @property string $codigoine
 * @property integer $padre
 * @property string $siglas
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class Profesion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.profesion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'codigoine'], 'required'],
            [['largo', 'padre'], 'integer'],
            [['codigo', 'codigoine'], 'string', 'max' => 15],
            [['nombre'], 'string', 'max' => 150],
            [['nivel'], 'string', 'max' => 4],
            [['siglas'], 'string', 'max' => 6],
            [['codigo'], 'unique'],
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
            'nivel' => 'Nivel',
            'largo' => 'Largo',
            'codigoine' => 'Codigoine',
            'padre' => 'Padre',
            'siglas' => 'Siglas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['id_profesion' => 'id']);
    }
}
