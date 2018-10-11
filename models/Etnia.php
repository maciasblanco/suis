<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.etnia".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class Etnia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.etnia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['id_etnia' => 'id']);
    }
}
