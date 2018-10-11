<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.municipio".
 *
 * @property string $codigo_municipio
 * @property string $municipio
 * @property string $codigo_estado
 *
 * @property Estado $codigoEstado
 * @property Estado $codigoEstado0
 * @property Parroquia[] $parroquias
 * @property DatosRepresentante[] $datosRepresentantes
 * @property Certificado[] $certificados
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.municipio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_municipio'], 'required'],
            [['codigo_municipio'], 'string', 'max' => 4],
            [['municipio'], 'string', 'max' => 50],
            [['codigo_estado'], 'string', 'max' => 2],
            [['codigo_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['codigo_estado' => 'codigo_estado']],
            [['codigo_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['codigo_estado' => 'codigo_estado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo_municipio' => 'Codigo Municipio',
            'municipio' => 'Municipio',
            'codigo_estado' => 'Codigo Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoEstado()
    {
        return $this->hasOne(Estado::className(), ['codigo_estado' => 'codigo_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoEstado0()
    {
        return $this->hasOne(Estado::className(), ['codigo_estado' => 'codigo_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquias()
    {
        return $this->hasMany(Parroquia::className(), ['codigo_municipio' => 'codigo_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['codigo_municipio' => 'codigo_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['codigo_municipio' => 'codigo_municipio']);
    }
}
