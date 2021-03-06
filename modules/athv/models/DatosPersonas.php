<?php

namespace app\modules\athv\models;

use Yii;

/**
 * This is the model class for table "general.datos_persona".
 *
 * @property int $id
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $nacionalidad
 * @property int $parroquia_id
 * @property string $sexo
 * @property string $cedula
 * @property string $telefono
 * @property string $fechanac
 * @property bool $carnet_patria este campo es para verificar si existe o no el carnet es booleano
 * @property string $codigo_carnet el codigo del carnet
 * @property string $serial_carnet serial del carnet ejem 0004769147
 *
 * @property Parroquia $parroquia
 * @property RenglonEpi10[] $renglonEpi10s
 * @property Embarazadas[] $embarazadas
 * @property Medicos[] $medicos
 * @property MedicosSegunUbicacion[] $medicosSegunUbicacions
 */
class DatosPersonas extends \yii\db\ActiveRecord
{

    public $estado;
    public $municipio;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general.datos_persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parroquia_id'], 'default', 'value' => null],
            [['parroquia_id'], 'integer'],
            [['cedula', 'telefono'], 'number'],
            [['fechanac', 'estado', 'municipio'], 'safe'],
            [['carnet_patria'], 'boolean'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 50],
            [['nacionalidad', 'sexo'], 'string', 'max' => 1],
            [['codigo_carnet', 'serial_carnet'], 'string', 'max' => 11],
            [['parroquia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['parroquia_id' => 'id_parroquia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'nacionalidad' => 'Nacionalidad',
            'parroquia_id' => 'Parroquia ID',
            'sexo' => 'Sexo',
            'cedula' => 'Cedula',
            'telefono' => 'Telefono',
            'fechanac' => 'Fecha de Nacimiento',
            'carnet_patria' => 'Carnet Patria',
            'codigo_carnet' => 'Codigo Carnet',
            'serial_carnet' => 'Serial Carnet',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id_parroquia' => 'parroquia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenglonEpi10s()
    {
        return $this->hasMany(RenglonEpi10::className(), ['hpaciente' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmbarazadas()
    {
        return $this->hasMany(Embarazadas::className(), ['id_datos_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicos()
    {
        return $this->hasMany(Medicos::className(), ['datos_persona_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicosSegunUbicacions()
    {
        return $this->hasMany(MedicosSegunUbicacion::className(), ['id_datos_persona' => 'id']);
    }
}
