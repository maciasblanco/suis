<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.sexo".
 *
 * @property integer $id
 * @property string $descripcion
 *
 * @property Certificado[] $certificados
 */
class Sexo extends \yii\db\ActiveRecord
{
    const F = 1;
    const M = 2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.sexo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['letra'], 'string', 'max' => 1],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'letra' => 'Letra',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['id_sexo' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->letra;
    }
}
