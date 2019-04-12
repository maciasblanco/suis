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
 * @property AccidenteTransito[] $accidenteTransitos
 * @property HechoViolento[] $hechoViolentos
 * @property DatosAtencion[] $datosAtencions
 * @property Parroquia $parroquia
 * @property RenglonEpi10[] $renglonEpi10s
 * @property SeccionI[] $seccionIs
 * @property SeccionVII[] $seccionVIIs
 * @property MenorEdad[] $menorEdads
 * @property Embarazadas[] $embarazadas
 * @property Medicos[] $medicos
 * @property MedicosSegunUbicacion[] $medicosSegunUbicacions
 * @property MenorEdad[] $menorEdads0
 * @property Vacunaciones[] $vacunaciones
 * @property VacunasPersona[] $vacunasPersonas
 */
class DatosPersona extends \yii\db\ActiveRecord
{
    public $estado;
    public $municipio;

    public $ownNoCedulado;

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
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'default', 'value' => null],
            [['nro_hijo'], 'default', 'value' => 0],
            [['id_nacionalidad'], 'required'],
            [['cedula'], 'required', 'when' => function ($model) {
                return empty($this->primer_nombre);
            }],
            [['primer_nombre'], 'required', 'when' => function ($model) {
                return empty($this->cedula);
            }],
            [['id_parroquia'], 'default', 'value' => null],
            [['id_nacionalidad', 'id_parroquia', 'nro_hijo'], 'integer'],
            [['cedula'], 'number'],
            [['fecha_nac'], 'safe'],
            [['estado', 'municipio'],'safe'],
            [['carnet_patria', 'ownNoCedulado'], 'boolean'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 50],
            [['id_sexo'], 'string', 'max' => 1],
            [['codigo_carnet', 'serial_carnet'], 'string', 'max' => 11],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_nacionalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Nacionalidad::className(), 'targetAttribute' => ['id_nacionalidad' => 'id']],
            [['id_sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['id_sexo' => 'id']],
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
            'id_nacionalidad' => 'Nacionalidad',
            'id_parroquia' => 'Parroquia',
            'id_sexo' => 'Sexo',
            'cedula' => 'Cédula',
            'fecha_nac' => 'Fecha de Nacimiento',
            'carnet_patria' => 'Carnet Patria',
            'codigo_carnet' => 'Codigo Carnet',
            'serial_carnet' => 'Serial Carnet',
            'nro_hijo' => 'N° Hijo',
            'ownNoCedulado' => '¿Es niño no cedulado?',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccidenteTransitos()
    {
        return $this->hasMany(AccidenteTransito::className(), ['id_dato_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHechoViolentos()
    {
        return $this->hasMany(HechoViolento::className(), ['id_dato_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosAtencion()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_datos_personas' => 'id']);
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
    public function getRenglonEpi10s()
    {
        return $this->hasMany(RenglonEpi10::className(), ['hpaciente' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionIs()
    {
        return $this->hasMany(SeccionI::className(), ['datos_persona_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccionVIIs()
    {
        return $this->hasMany(SeccionVII::className(), ['registrador_civil' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenorEdads()
    {
        return $this->hasMany(MenorEdad::className(), ['id_representante' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenorEdads0()
    {
        return $this->hasMany(MenorEdad::className(), ['id_representante' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunaciones()
    {
        return $this->hasMany(Vacunaciones::className(), ['id_dato_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunasPersonas()
    {
        return $this->hasMany(VacunasPersona::className(), ['id_dato_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'id_sexo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunidad()
    {
        return $this->hasone(Comunidad::className(), ['id' => 'id_comunidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosUbicacion()
    {
        return $this->hasone(DatosUbicacion::className(), ['id_datos_persona' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosContacto()
    {
        return $this->hasone(DatosContacto::className(), ['id_datos_persona' => 'id']);
    }

    /**
     *
     */
    public function afterFind()
    {
        parent::afterFind();

        if (!empty($this->id_parroquia)) {
            $this->municipio = $this->parroquia->codigoMunicipio->codigo_municipio;
            $this->estado = $this->parroquia->codigoMunicipio->codigo_estado;
        }

        if (!empty($this->fecha_nac)) {
            $this->fecha_nac = date('d-m-Y', strtotime($this->fecha_nac));
        }

        $this->ownNoCedulado = ($this->nro_hijo != 0) ? 1 : 0;
    }

    /**
     * Nombres
     */
    public function getNombres()
    {
        return implode(' ', [$this->primer_nombre, $this->segundo_nombre]);
    }

    /**
     * Apellidos
     */
    public function getApellidos()
    {
        return implode(' ', [$this->primer_apellido, $this->segundo_apellido]);
    }

    /**
     * Nombres y Apellidos
     */
    public function getNombresApellidos()
    {
        return implode(' ', [$this->nombres, $this->apellidos]);
    }
}
