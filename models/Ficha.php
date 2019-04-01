<?php

namespace frontend\models;

use Yii;
use common\models\Enfermedades;
use common\models\Discapacidad;
use backend\models\TipoRequerimiento;
use backend\models\TipoSolicitud;
use common\models\Tratamiento;

/**
 * This is the model class for table "sigca.ficha".
 *
 * @property integer $id
 * @property integer $id_tipo_requerimiento
 * @property integer $id_tipo_solicitud
 * @property integer $id_estatus
 * @property string $fecha_solicitud
 * @property string $fecha_registro
 * @property string $descripcion
 * @property integer $id_datos_personales
 * @property integer $id_enfermedad
 * @property integer $id_tratamiento
 * @property integer $id_discapacidad
 *
 * @property Cie10 $idEnfermedad
 * @property Discapacidad $idDiscapacidad
 * @property Estatus $idEstatus
 * @property TipoRequerimiento $idTipoRequerimiento
 * @property TipoSolicitud $idTipoSolicitud
 * @property Tratamiento $idTratamiento
 * @property DatosPersonales $idDatosPersonales
 */
class Ficha extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sigca.ficha';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_requerimiento', 'id_tipo_solicitud', 'id_estatus', 'id_datos_personales', 'id_enfermedad', 'id_tratamiento', 'id_discapacidad'], 'integer'],
            [['fecha_solicitud', 'fecha_registro','caso'], 'safe'],
            [['descripcion', 'tipo_requerimiento'], 'string'],
            [['id_enfermedad'], 'exist', 'skipOnError' => true, 'targetClass' => Enfermedades::className(), 'targetAttribute' => ['id_enfermedad' => 'seq_id_actual']],
            [['id_discapacidad'], 'exist', 'skipOnError' => true, 'targetClass' => Discapacidad::className(), 'targetAttribute' => ['id_discapacidad' => 'id']],
            [['id_estatus'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::className(), 'targetAttribute' => ['id_estatus' => 'id']],
            [['id_tipo_requerimiento'], 'exist', 'skipOnError' => true, 'targetClass' => TipoRequerimiento::className(), 'targetAttribute' => ['id_tipo_requerimiento' => 'id']],
            [['id_tipo_solicitud'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSolicitud::className(), 'targetAttribute' => ['id_tipo_solicitud' => 'id']],
            [['id_tratamiento'], 'exist', 'skipOnError' => true, 'targetClass' => Tratamiento::className(), 'targetAttribute' => ['id_tratamiento' => 'id']],
            [['id_datos_personales'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_datos_personales' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tipo_requerimiento' => 'Id Tipo Requerimiento',
            'id_tipo_solicitud' => 'Id Tipo Solicitud',
            'id_estatus' => 'Id Estatus',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_registro' => 'Fecha Registro',
            'descripcion' => 'Descripcion',
            'id_datos_personales' => 'Id Datos Personales',
            'id_enfermedad' => 'Id Enfermedad',
            'id_tratamiento' => 'Id Tratamiento',
            'id_discapacidad' => 'Id Discapacidad',
            'caso' => 'Caso',
            'tipo_requerimiento' => 'Tipo de Requerimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEnfermedad()
    {
        return $this->hasOne(Enfermedades::className(), ['seq_id_actual' => 'id_enfermedad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDiscapacidad()
    {
        return $this->hasOne(Discapacidad::className(), ['id' => 'id_discapacidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstatus()
    {
        return $this->hasOne(Estatus::className(), ['id' => 'id_estatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoRequerimiento()
    {
        return $this->hasOne(TipoRequerimiento::className(), ['id' => 'id_tipo_requerimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoSolicitud()
    {
        return $this->hasOne(TipoSolicitud::className(), ['id' => 'id_tipo_solicitud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTratamiento()
    {
        return $this->hasOne(Tratamiento::className(), ['id' => 'id_tratamiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosPersonales()
    {
       // return $this->hasOne(DatosPersonales::className(), ['id' => 'id_datos_personales']);
       return $this->hasOne(Personal::className(), ['id' => 'id_datos_personales']);
    }
}
