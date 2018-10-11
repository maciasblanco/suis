<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.parroquia".
 *
 * @property string $codigo_parroquia
 * @property string $parroquia
 * @property string $codigo_municipio
 *
 * @property Comunidad[] $comunidads
 * @property Municipio $codigoMunicipio
 * @property DatosRepresentante[] $datosRepresentantes
 * @property Certificado[] $certificados
 */
class Parroquia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.parroquia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_parroquia'], 'required'],
            [['codigo_parroquia'], 'string', 'max' => 12],
            [['parroquia'], 'string', 'max' => 60],
            [['codigo_municipio'], 'string', 'max' => 4],
            [['codigo_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['codigo_municipio' => 'codigo_municipio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo_parroquia' => 'Codigo Parroquia',
            'parroquia' => 'Parroquia',
            'codigo_municipio' => 'Codigo Municipio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunidads()
    {
        return $this->hasMany(Comunidad::className(), ['codigo_parroquia' => 'codigo_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['codigo_municipio' => 'codigo_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['codigo_paroquia' => 'codigo_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['codigo_paroquia' => 'codigo_parroquia']);
    }
}
