<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.paises".
 *
 * @property integer $id
 * @property string $alfa2
 * @property string $alfa3
 * @property string $numerico
 * @property string $nombre_esp
 * @property string $nombre_ing
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class Paises extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.paises';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alfa2', 'alfa3', 'numerico'], 'required'],
            [['alfa2'], 'string', 'max' => 2],
            [['alfa3', 'numerico'], 'string', 'max' => 3],
            [['nombre_esp', 'nombre_ing'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alfa2' => 'Alfa2',
            'alfa3' => 'Alfa3',
            'numerico' => 'Numerico',
            'nombre_esp' => 'Nombre Esp',
            'nombre_ing' => 'Nombre Ing',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['id_lugar_nacimiento' => 'id']);
    }
}
