<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.nacionalidad".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $letra
 *
 * @property DatosRepresentante[] $datosRepresentantes
 */
class Nacionalidad extends \yii\db\ActiveRecord
{
    const V = 1;
    const E = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.nacionalidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'letra'], 'required'],
            [['nombre'], 'string', 'max' => 50],
            [['letra'], 'string', 'max' => 1],
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
            'letra' => 'Letra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['id_nacionalidad' => 'id']);
    }
}
