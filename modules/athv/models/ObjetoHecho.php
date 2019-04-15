<?php

namespace app\modules\athv\models;

use Yii;

/**
 * This is the model class for table "catalogo.objeto_hecho".
 *
 * @property int $id
 * @property string $descripcion
 */
class ObjetoHecho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.objeto_hecho';
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
            'descripcion' => 'descripcion',
        ];
    }
}
