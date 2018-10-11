<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.nivel_educativo".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class NivelEducativo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.nivel_educativo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 50],
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
        return $this->hasMany(DatosRepresentante::className(), ['id_nivel_educativo' => 'id']);
    }
}
