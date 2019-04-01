<?php

namespace frontend\models;

use Yii;
use common\models\Sexo;

/**
 * This is the model class for table "cirugia.datos_personales".
 *
 * @property integer $id
 * @property string $nacionalidad
 * @property integer $cedula
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_nac
 * @property integer $id_sexo
 * @property boolean $carnet
 * @property string $cod_carnet
 * @property boolean $clap
 * @property string $nombre_clap
 * @property boolean $enfermedad_cronica
 * @property string $nombre_enfermedad
 *
 * @property DatosContacto[] $datosContactos
 * @property Sexo $idSexo
 */
class DatosPersonales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.datos_personales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cedula', 'carnet', 'clap', 'enfermedad_cronica'], 'required'],
            [['cedula', 'id_sexo'], 'integer'],
            [['nombres', 'apellidos', 'otras_cirugias'], 'string'],
            [['fecha_nac'], 'safe'],
            [['carnet', 'clap', 'enfermedad_cronica'], 'boolean'],
            [['nacionalidad'], 'string', 'max' => 2],
            [['cod_carnet', 'nombre_clap', 'nombre_enfermedad'], 'string', 'max' => 100],
            [['cedula'], 'unique'],
            [['id_sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['id_sexo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nacionalidad' => 'Nacionalidad',
            'cedula' => 'Cedula',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'fecha_nac' => 'Fecha Nac',
            'id_sexo' => 'Id Sexo',
            'carnet' => 'Carnet',
            'cod_carnet' => 'Cod Carnet',
            'clap' => 'Clap',
            'nombre_clap' => 'Nombre Clap',
            'enfermedad_cronica' => 'Enfermedad Cronica',
            'nombre_enfermedad' => 'Nombre Enfermedad',
            'otras_cirugias' => 'Otras Cirugías',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosContactos()
    {
        return $this->hasMany(DatosContacto::className(), ['id_datos_personales' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'id_sexo']);
    }
}
