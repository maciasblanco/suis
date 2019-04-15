<?php

namespace app\modules\athv\models;

use Yii;

/**
 * This is the model class for table "catalogo.parroquia".
 *
 * @property string $codigo_parroquia
 * @property string $parroquia
 * @property string $codigo_municipio
 * @property int $id_parrofarma
 * @property int $id_parroquia
 */
class Parroquia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.parroquia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_parroquia', 'parroquia', 'codigo_municipio'], 'required'],
            [['id_parrofarma'], 'default', 'value' => null],
            [['id_parrofarma'], 'integer'],
            [['codigo_parroquia'], 'string', 'max' => 12],
            [['parroquia'], 'string', 'max' => 50],
            [['codigo_municipio'], 'string', 'max' => 4],
            [['codigo_parroquia'], 'unique'],
            [['codigo_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['codigo_municipio' => 'codigo_municipio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_parroquia' => 'Codigo Parroquia',
            'parroquia' => 'Parroquia',
            'codigo_municipio' => 'Codigo Municipio',
            'id_parrofarma' => 'Id Parrofarma',
            'id_parroquia' => 'Id Parroquia',
        ];
    }
}
