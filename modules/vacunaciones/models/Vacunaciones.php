<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "vacunacion.vacunaciones".
 *
 * @property int $id
 * @property int $id_dato_persona
 * @property string $fecha
 * @property int $id_vacuna
 * @property int $id_dosis
 * @property int $id_establecimiento
 * @property int $id_grupo_edad
 * @property int $id_tipo_mision
 * @property int $n_hijo
 * @property string $lote_amarilica
 * @property int $id_tipo_vacunacion
 * @property int $id_condicion_especial
 * @property bool $menor_edad
 * @property string $nombres_menor
 * @property string $apellidos_menor
 * @property string $fecha_nac
 * @property string $sexo
 */
class Vacunaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunacion.vacunaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dato_persona', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_grupo_edad', 'id_tipo_mision', 'n_hijo', 'id_tipo_vacunacion', 'id_condicion_especial'], 'default', 'value' => null],
            [['id_dato_persona', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_grupo_edad', 'id_tipo_mision', 'n_hijo', 'id_tipo_vacunacion', 'id_condicion_especial'], 'integer'],
            [['fecha', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_grupo_edad', 'id_tipo_mision', 'id_tipo_vacunacion'], 'required'],
            [['fecha', 'fecha_nac'], 'safe'],
            [['lote_amarilica'], 'string'],
            [['menor_edad'], 'boolean'],
            [['nombres_menor', 'apellidos_menor'], 'string', 'max' => 50],
            [['sexo'], 'string', 'max' => 1],
            [['id_condicion_especial'], 'exist', 'skipOnError' => true, 'targetClass' => CondicionEspecial::className(), 'targetAttribute' => ['id_condicion_especial' => 'id']],
            [['id_dosis'], 'exist', 'skipOnError' => true, 'targetClass' => Dosis::className(), 'targetAttribute' => ['id_dosis' => 'id']],
            [['id_establecimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Establecimiento::className(), 'targetAttribute' => ['id_establecimiento' => 'id']],
            [['id_grupo_edad'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoEdad::className(), 'targetAttribute' => ['id_grupo_edad' => 'id']],
            [['id_tipo_mision'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMision::className(), 'targetAttribute' => ['id_tipo_mision' => 'id']],
            [['id_tipo_vacunacion'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVacunacion::className(), 'targetAttribute' => ['id_tipo_vacunacion' => 'id']],
            [['id_vacuna'], 'exist', 'skipOnError' => true, 'targetClass' => Vacuna::className(), 'targetAttribute' => ['id_vacuna' => 'id']],
            [['id_dato_persona'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersona::className(), 'targetAttribute' => ['id_dato_persona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dato_persona' => 'Id Dato Persona',
            'fecha' => 'Fecha',
            'id_vacuna' => 'Id Vacuna',
            'id_dosis' => 'Id Dosis',
            'id_establecimiento' => 'Id Establecimiento',
            'id_grupo_edad' => 'Id Grupo Edad',
            'id_tipo_mision' => 'Id Tipo Mision',
            'n_hijo' => 'N Hijo',
            'lote_amarilica' => 'Lote Amarilica',
            'id_tipo_vacunacion' => 'Id Tipo Vacunacion',
            'id_condicion_especial' => 'Id Condicion Especial',
            'menor_edad' => 'Menor Edad',
            'nombres_menor' => 'Nombres Menor',
            'apellidos_menor' => 'Apellidos Menor',
            'fecha_nac' => 'Fecha Nac',
            'sexo' => 'Sexo',
        ];
    }
}
