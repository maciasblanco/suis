<?php

namespace app\modules\athv\models;

use Yii;

/**
 * This is the model class for table "athv.accidente_transito".
 *
 * @property int $id
 * @property int $id_parroquia
 * @property string $direccion
 * @property int $id_sitio_muerte
 * @property string $observacion
 * @property int $id_tipo_accidente
 * @property int $id_tipo_vehiculo
 * @property int $id_tipo_afectado
 * @property int $id_diagnostico_asociado
 * @property int $id_diagnostico_ubicacion
 * @property int $id_dato_persona
 *
 * @property DiagnosticoAsociado $diagnosticoAsociado
 * @property DiagnosticoUbicacion $diagnosticoUbicacion
 * @property Parroquia $parroquia
 * @property SitioMuerte $sitioMuerte
 * @property TipoAccidente $tipoAccidente
 * @property TipoAccidente $tipoVehiculo
 * @property TipoAfectado $tipoAfectado
 * @property DatosPersona $datoPersona
 */
class AccidenteTransito extends \yii\db\ActiveRecord
{

    public $estado;
    public $municipio;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'athv.accidente_transito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parroquia', 'direccion', 'id_tipo_accidente', 'id_tipo_vehiculo', 'id_tipo_afectado', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_dato_persona'], 'required'],
            [['id_parroquia', 'id_sitio_muerte', 'id_tipo_accidente', 'id_tipo_vehiculo', 'id_tipo_afectado', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_dato_persona'], 'default', 'value' => null],
            [['id_parroquia', 'id_sitio_muerte', 'id_tipo_accidente', 'id_tipo_vehiculo', 'id_tipo_afectado', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_dato_persona'], 'integer'],
            [['direccion', 'observacion'], 'string'],
            [['estado', 'municipio'], 'safe'],
            [['id_diagnostico_asociado'], 'exist', 'skipOnError' => true, 'targetClass' => DiagnosticoAsociado::className(), 'targetAttribute' => ['id_diagnostico_asociado' => 'id']],
            [['id_diagnostico_ubicacion'], 'exist', 'skipOnError' => true, 'targetClass' => DiagnosticoUbicacion::className(), 'targetAttribute' => ['id_diagnostico_ubicacion' => 'id']],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_sitio_muerte'], 'exist', 'skipOnError' => true, 'targetClass' => SitioMuerte::className(), 'targetAttribute' => ['id_sitio_muerte' => 'id']],
            [['id_tipo_accidente'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAccidente::className(), 'targetAttribute' => ['id_tipo_accidente' => 'id']],
            [['id_tipo_vehiculo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAccidente::className(), 'targetAttribute' => ['id_tipo_vehiculo' => 'id']],
            [['id_tipo_afectado'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAfectado::className(), 'targetAttribute' => ['id_tipo_afectado' => 'id']],
            [['id_dato_persona'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersonas::className(), 'targetAttribute' => ['id_dato_persona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parroquia' => 'Parroquia',
            'direccion' => 'Direccion',
            'id_sitio_muerte' => 'Sitio de la Muerte',
            'observacion' => 'Observacion',
            'id_tipo_accidente' => 'Tipo de Accidente',
            'id_tipo_vehiculo' => 'Tipo de Vehiculo',
            'id_tipo_afectado' => 'Tipo de Afectado',
            'id_diagnostico_asociado' => 'Diagnostico Asociado',
            'id_diagnostico_ubicacion' => 'Ubicacion del Diagnostico',
            'id_dato_persona' => 'Persona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticoAsociado()
    {
        return $this->hasOne(DiagnosticoAsociado::className(), ['id' => 'id_diagnostico_asociado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticoUbicacion()
    {
        return $this->hasOne(DiagnosticoUbicacion::className(), ['id' => 'id_diagnostico_ubicacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id_parroquia' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitioMuerte()
    {
        return $this->hasOne(SitioMuerte::className(), ['id' => 'id_sitio_muerte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAccidente()
    {
        return $this->hasOne(TipoAccidente::className(), ['id' => 'id_tipo_accidente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoVehiculo()
    {
        return $this->hasOne(TipoAccidente::className(), ['id' => 'id_tipo_vehiculo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAfectado()
    {
        return $this->hasOne(TipoAfectado::className(), ['id' => 'id_tipo_afectado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonas()
    {
        return $this->hasOne(DatosPersonas::className(), ['id' => 'id_dato_persona']);
    }
}
