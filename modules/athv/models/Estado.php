<?php

namespace app\modules\athv\models;

use Yii;

/**
 * This is the model class for table "catalogo.estado".
 *
 * @property string $codigo_estado
 * @property string $estado
 * @property int $id_edofarma
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_estado', 'estado'], 'required'],
            [['id_edofarma'], 'default', 'value' => null],
            [['id_edofarma'], 'integer'],
            [['codigo_estado'], 'string', 'max' => 2],
            [['estado'], 'string', 'max' => 50],
            [['codigo_estado'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_estado' => 'Codigo Estado',
            'estado' => 'Estado',
            'id_edofarma' => 'Id Edofarma',
        ];
    }
}
