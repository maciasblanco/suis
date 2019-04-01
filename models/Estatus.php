<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "catalogo.estatus".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property SigcaFicha[] $sigcaFichas
 */
class estatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.estatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string'],
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
    public function getSigcaFichas()
    {
        return $this->hasMany(SigcaFicha::className(), ['id_estatus' => 'id']);
    }
}
