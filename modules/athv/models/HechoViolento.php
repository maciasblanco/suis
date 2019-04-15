<?php

namespace app\modules\athv\models;

use Yii;

/**
 * This is the model class for table "athv.hecho_violento".
 *
 * @property int $id
 * @property int $id_parroquia
 * @property string $direccion
 * @property int $id_lugar_hecho
 * @property int $id_sitio_muerte
 * @property string $observacion
 * @property int $id_tipo_hecho
 * @property int $id_diagnostico_asociado
 * @property int $id_diagnostico_ubicacion
 * @property int $id_objeto_hecho
 *
 * @property DiagnosticoAsociado $diagnosticoAsociado
 * @property DiagnosticoUbicacion $diagnosticoUbicacion
 * @property ObjetoHecho $objetoHecho
 * @property Parroquia $parroquia
 * @property SitioMuerte $sitioMuerte
 * @property TipoHecho $tipoHecho
 */
class HechoViolento extends \yii\db\ActiveRecord
{

    public $municipio;
    public $estado;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'athv.hecho_violento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parroquia', 'direccion', 'id_lugar_hecho', 'id_tipo_hecho', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_objeto_hecho', 'id_dato_persona'], 'required'],
            [['id_parroquia', 'id_lugar_hecho', 'id_sitio_muerte', 'id_tipo_hecho', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_objeto_hecho'], 'default', 'value' => null],
            [['id_parroquia', 'id_lugar_hecho', 'id_sitio_muerte', 'id_tipo_hecho', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_objeto_hecho'], 'integer'],
            [['direccion', 'observacion'], 'string'],
            [['estado','municipio'], 'safe'],
            [['id_diagnostico_asociado'], 'exist', 'skipOnError' => true, 'targetClass' => DiagnosticoAsociado::className(), 'targetAttribute' => ['id_diagnostico_asociado' => 'id']],
            [['id_diagnostico_ubicacion'], 'exist', 'skipOnError' => true, 'targetClass' => DiagnosticoUbicacion::className(), 'targetAttribute' => ['id_diagnostico_ubicacion' => 'id']],
            [['id_objeto_hecho'], 'exist', 'skipOnError' => true, 'targetClass' => ObjetoHecho::className(), 'targetAttribute' => ['id_objeto_hecho' => 'id']],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_sitio_muerte'], 'exist', 'skipOnError' => true, 'targetClass' => SitioMuerte::className(), 'targetAttribute' => ['id_sitio_muerte' => 'id']],
            [['id_tipo_hecho'], 'exist', 'skipOnError' => true, 'targetClass' => TipoHecho::className(), 'targetAttribute' => ['id_tipo_hecho' => 'id']],
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
            'id_lugar_hecho' => 'Lugar del Hecho',
            'id_sitio_muerte' => 'Sitio de la Muerte',
            'observacion' => 'Observacion',
            'id_tipo_hecho' => 'Tipo Hecho Violento',
            'id_diagnostico_asociado' => 'Diagnostico Asociado',
            'id_diagnostico_ubicacion' => 'Ubicacion del Diagnostico',
            'id_objeto_hecho' => 'Objeto del Hecho',
            'id_dato_persona' => 'Persona'
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
    public function getObjetoHecho()
    {
        return $this->hasOne(ObjetoHecho::className(), ['id' => 'id_objeto_hecho']);
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
    public function getTipoHecho()
    {
        return $this->hasOne(TipoHecho::className(), ['id' => 'id_tipo_hecho']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLugarHecho()
    {
        return $this->hasOne(LugarHecho::className(), ['id' => 'id_lugar_hecho']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonas()
    {
        return $this->hasOne(DatosPersonas::className(), ['id' => 'id_dato_persona']);
    }
}
