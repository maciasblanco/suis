<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "catalogo.municipio".
 *
 * @property string $codigo_municipio
 * @property string $municipio
 * @property string $codigo_estado
 * @property int $id_munifarma
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_municipio', 'municipio', 'codigo_estado'], 'required'],
            [['id_munifarma'], 'default', 'value' => null],
            [['id_munifarma'], 'integer'],
            [['codigo_municipio'], 'string', 'max' => 4],
            [['municipio'], 'string', 'max' => 50],
            [['codigo_estado'], 'string', 'max' => 2],
            [['codigo_municipio'], 'unique'],
            [['codigo_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['codigo_estado' => 'codigo_estado']],
            [['codigo_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['codigo_estado' => 'codigo_estado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_municipio' => 'Codigo Municipio',
            'municipio' => 'Municipio',
            'codigo_estado' => 'Codigo Estado',
            'id_munifarma' => 'Id Munifarma',
        ];
    }
}
