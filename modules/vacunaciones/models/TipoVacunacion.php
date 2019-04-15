<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "catalogo.tipo_vacunacion".
 *
 * @property int $id
 * @property string $descripcion
 */
class TipoVacunacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.tipo_vacunacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
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
