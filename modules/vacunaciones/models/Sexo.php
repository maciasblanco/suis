<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "catalogo.sexo".
 *
 * @property int $id
 * @property string $descripcion Sexo
 * @property string $nombre
 *
 * @property MenorEdad[] $menorEdads
 */
class Sexo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.sexo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 255],
            [['nombre'], 'string', 'max' => 50],
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
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenorEdads()
    {
        return $this->hasMany(MenorEdad::className(), ['id_sexo' => 'id']);
    }
}
