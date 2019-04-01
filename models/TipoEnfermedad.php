<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.tipo_enfermedad".
 *
 * @property int $id
 * @property string $descripcion aqui estan los tipos de enfermedades
 */
class TipoEnfermedad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.tipo_enfermedad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 70],
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
}
