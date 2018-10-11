<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.tipo_documento".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class TipoDocumento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.tipo_documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['id_tipo_documento' => 'id']);
    }
}
