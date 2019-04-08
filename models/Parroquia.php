<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.parroquia".
 *
 * @property string $codigo_parroquia
 * @property string $parroquia
 * @property string $codigo_municipio
 * @property int $id_parrofarma ID Parroquia Farmapatria
 * @property int $id_parroquia
 *
 * @property Comunidad[] $comunidads
 * @property Establecimiento[] $establecimientos
 * @property Municipio $codigoMunicipio
 * @property DatosPersona[] $datosPersonas
 * @property SeccionI[] $seccionIs
 * @property SeccionI[] $seccionIs0
 * @property SeccionII[] $seccionIIs
 * @property SeccionIII[] $seccionIIIs
 * @property SeccionVII[] $seccionVIIs
 */
class Parroquia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.parroquia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_parroquia', 'parroquia', 'codigo_municipio', 'id_parrofarma'], 'default', 'value' => null],
            [['codigo_parroquia', 'parroquia', 'codigo_municipio'], 'required'],
            [['id_parrofarma'], 'integer'],
            [['codigo_parroquia'], 'string', 'max' => 12],
            [['parroquia'], 'string', 'max' => 50],
            [['codigo_municipio'], 'string', 'max' => 4],
            [['codigo_parroquia'], 'unique'],
            [['codigo_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['codigo_municipio' => 'codigo_municipio']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_parroquia' => Yii::t('app', 'Codigo Parroquia'),
            'parroquia' => Yii::t('app', 'Parroquia'),
            'codigo_municipio' => Yii::t('app', 'Codigo Municipio'),
            'id_parrofarma' => Yii::t('app', 'Id Parrofarma'),
            'id_parroquia' => Yii::t('app', 'Id Parroquia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunidads()
    {
        return $this->hasMany(Comunidad::className(), ['id_parroquia' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimientos()
    {
        return $this->hasMany(Establecimiento::className(), ['id_parroquia' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['codigo_municipio' => 'codigo_municipio']);
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
    public function getDatosPersonas()
    {
        return $this->hasMany(DatosPersona::className(), ['id_parroquia' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionIs()
    {
        return $this->hasMany(SeccionI::className(), ['parroquia_id' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionIs0()
    {
        return $this->hasMany(SeccionI::className(), ['parroquia_id_II' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionIIs()
    {
        return $this->hasMany(SeccionII::className(), ['parroquia_id_II' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionIIIs()
    {
        return $this->hasMany(SeccionIII::className(), ['parroquia_id' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionVIIs()
    {
        return $this->hasMany(SeccionVII::className(), ['parroquia_id' => 'id_parroquia']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->parroquia;
    }
}
