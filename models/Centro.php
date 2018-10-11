<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.centro".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_comunidad
 *
 * @property Comunidad $idComunidad
 * @property Certificado[] $certificados
 */
class Centro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.centro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string'],
            [['id_comunidad'], 'integer'],
            [['id_comunidad'], 'exist', 'skipOnError' => true, 'targetClass' => Comunidad::className(), 'targetAttribute' => ['id_comunidad' => 'id']],
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
            'id_comunidad' => 'Id Comunidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdComunidad()
    {
        return $this->hasOne(Comunidad::className(), ['id' => 'id_comunidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['id_centro' => 'id']);
    }
}
