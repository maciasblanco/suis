<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "catalogo.grupo_edad".
 *
 * @property int $id
 * @property string $descripcion
 */
class GrupoEdad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.grupo_edad';
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
