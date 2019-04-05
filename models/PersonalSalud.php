<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.personal_salud".
 *
 * @property int $id
 * @property int $cedula
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property int $id_sexo
 * @property string $fecha_nac
 * @property int $licencia
 * @property int $tipo_personal 1 => Medico, 2 => Enfermera
 *
 * @property Sexo $sexo
 * @property Epi10[] $epi10s
 * @property Epi10[] $epi10s0
 */
class PersonalSalud extends \yii\db\ActiveRecord
{
    const MEDICO = 1;
    const ENFERMERA = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.personal_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'primer_nombre', 'primer_apellido', 'licencia', 'fecha_nac', 'id_sexo', 'tipo_personal'], 'default', 'value' => null],
            [['cedula', 'primer_apellido'], 'required'],
            [['cedula', 'id_sexo', 'licencia', 'tipo_personal'], 'default', 'value' => null],
            [['cedula', 'id_sexo', 'licencia', 'tipo_personal'], 'integer'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'string'],
            [['fecha_nac'], 'safe'],
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
            'cedula' => 'Cedula',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'id_sexo' => 'Id Sexo',
            'fecha_nac' => 'Fecha Nac',
            'licencia' => 'Licencia',
            'tipo_personal' => 'Tipo Personal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'id_sexo']);
    }

    /**
     * @return string Nombre completo
     */
    public function getNombreCompleto()
    {
        return implode(' ', array_filter([
            $this->primer_apellido, $this->segundo_apellido,
            $this->primer_nombre, $this->segundo_nombre
        ]));
    }

    /**
     * @return string Cedula y nombre completo
     */
    public function getCedulaYNombreCompleto()
    {
        return implode(' ', [
            $this->cedula,
            $this->nombreCompleto
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombreCompleto;
    }
}
