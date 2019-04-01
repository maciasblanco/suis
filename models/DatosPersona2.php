<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general.datos_persona".
 *
 * @property int $id
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property int $id_nacionalidad
 * @property int $id_parroquia
 * @property int $id_sexo
 * @property int $cedula
 * @property string $fecha_nac
 * @property bool $carnet_patria este campo es para verificar si existe o no el carnet es booleano
 * @property string $codigo_carnet el codigo del carnet
 * @property string $serial_carnet serial del carnet ejem 0004769147
 * @property int $id_comunidad
 * @property int $nro_hijo
 *
 * @property Paciente[] $pacientes
 * @property DatosContacto[] $datosContactos
 * @property Comunidad $comunidad
 * @property Nacionalidad $nacionalidad
 * @property Parroquia $parroquia
 * @property Sexo $sexo
 */
class DatosPersona2 extends \yii\db\ActiveRecord
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
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'id_nacionalidad', 'id_parroquia', 'id_sexo', 'cedula', 'fecha_nac', 'carnet_patria', 'codigo_carnet', 'serial_carnet', 'id_comunidad', 'nro_hijo'], 'default', 'value' => null],
            [['id_nacionalidad', 'id_parroquia', 'cedula', 'id_comunidad', 'nro_hijo'], 'integer'],
            [['fecha_nac'], 'safe'],
            [['id_sexo'], 'string', 'max' => 1],
            [['estado', 'municipio'],'safe'],
            [['carnet_patria'], 'boolean'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 50],
            [['codigo_carnet', 'serial_carnet'], 'string', 'max' => 11],
            [['id_comunidad'], 'exist', 'skipOnError' => true, 'targetClass' => Comunidad::className(), 'targetAttribute' => ['id_comunidad' => 'id']],
            [['id_nacionalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Nacionalidad::className(), 'targetAttribute' => ['id_nacionalidad' => 'id']],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['id_sexo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'primer_nombre' => Yii::t('app', 'Primer Nombre'),
            'segundo_nombre' => Yii::t('app', 'Segundo Nombre'),
            'primer_apellido' => Yii::t('app', 'Primer Apellido'),
            'segundo_apellido' => Yii::t('app', 'Segundo Apellido'),
            'id_nacionalidad' => Yii::t('app', 'Nacionalidad'),
            'id_parroquia' => Yii::t('app', 'Parroquia'),
            'id_sexo' => Yii::t('app', 'Sexo'),
            'cedula' => Yii::t('app', 'Cedula'),
            'fecha_nac' => Yii::t('app', 'Fecha de Nacimiento'),
            'carnet_patria' => Yii::t('app', 'Carnet de la Patria'),
            'codigo_carnet' => Yii::t('app', 'Codigo del Carnet'),
            'serial_carnet' => Yii::t('app', 'Serial del Carnet'),
            'id_comunidad' => Yii::t('app', 'Comunidad'),
            'nro_hijo' => Yii::t('app', 'Nro de Hijo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_datos_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosContactos()
    {
        return $this->hasMany(DatosContacto::className(), ['id_datos_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunidad()
    {
        return $this->hasOne(Comunidad::className(), ['id' => 'id_comunidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNacionalidad()
    {
        return $this->hasOne(Nacionalidad::className(), ['id' => 'id_nacionalidad']);
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
    public function getSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'id_sexo']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->cedula;
    }
}
