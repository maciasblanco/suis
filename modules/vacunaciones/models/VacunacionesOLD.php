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
 * @property int $id_tipo_mision
 * @property int $n_hijo
 * @property string $lote_amarilica
 * @property int $id_tipo_vacunacion
 * @property int $id_condicion_especial
 * @property int $id_menor_edad
 *
 * @property CondicionEspecial $condicionEspecial
 * @property Dosis $dosis
 * @property Establecimiento $establecimiento
 * @property TipoMision $tipoMision
 * @property TipoVacunacion $tipoVacunacion
 * @property Vacuna $vacuna
 * @property DatosPersona $datoPersona
 * @property MenorEdad $menorEdad
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
            [['id_dato_persona', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_tipo_mision', 'n_hijo', 'id_tipo_vacunacion', 'id_condicion_especial', 'id_menor_edad'], 'default', 'value' => null],
            [['id_dato_persona', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_tipo_mision', 'n_hijo', 'id_tipo_vacunacion', 'id_condicion_especial', 'id_menor_edad'], 'integer'],
            [['fecha', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_tipo_mision', 'id_tipo_vacunacion'], 'required'],
            [['fecha'], 'safe'],
            [['lote_amarilica'], 'string'],
            [['id_condicion_especial'], 'exist', 'skipOnError' => true, 'targetClass' => CondicionEspecial::className(), 'targetAttribute' => ['id_condicion_especial' => 'id']],
            [['id_dosis'], 'exist', 'skipOnError' => true, 'targetClass' => Dosis::className(), 'targetAttribute' => ['id_dosis' => 'id']],
            [['id_establecimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Establecimiento::className(), 'targetAttribute' => ['id_establecimiento' => 'id']],
            [['id_grupo_edad'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoEdad::className(), 'targetAttribute' => ['id_grupo_edad' => 'id']],
            [['id_tipo_mision'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMision::className(), 'targetAttribute' => ['id_tipo_mision' => 'id']],
            [['id_tipo_vacunacion'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVacunacion::className(), 'targetAttribute' => ['id_tipo_vacunacion' => 'id']],
            [['id_vacuna'], 'exist', 'skipOnError' => true, 'targetClass' => Vacuna::className(), 'targetAttribute' => ['id_vacuna' => 'id']],
            [['id_dato_persona'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersona::className(), 'targetAttribute' => ['id_dato_persona' => 'id']],
            [['id_menor_edad'], 'exist', 'skipOnError' => true, 'targetClass' => MenorEdad::className(), 'targetAttribute' => ['id_menor_edad' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dato_persona' => 'Cedula',
            'fecha' => 'Fecha',
            'id_vacuna' => 'Vacuna',
            'id_dosis' => 'Dosis',
            'id_establecimiento' => 'Establecimiento',
            'id_tipo_mision' => 'Tipo Mision',
            'n_hijo' => 'Hijo número:',
            'lote_amarilica' => 'Lote Amarilica',
            'id_tipo_vacunacion' => 'Tipo Vacunacion',
            'id_condicion_especial' => 'Condicion Especial',
            'id_menor_edad' => 'Menor Edad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionEspecial()
    {
        return $this->hasOne(CondicionEspecial::className(), ['id' => 'id_condicion_especial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosis()
    {
        return $this->hasOne(Dosis::className(), ['id' => 'id_dosis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimiento()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'id_establecimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMision()
    {
        return $this->hasOne(TipoMision::className(), ['id' => 'id_tipo_mision']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoVacunacion()
    {
        return $this->hasOne(TipoVacunacion::className(), ['id' => 'id_tipo_vacunacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacuna()
    {
        return $this->hasOne(Vacuna::className(), ['id' => 'id_vacuna']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatoPersona()
    {
        return $this->hasOne(DatosPersona::className(), ['id' => 'id_dato_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenorEdad()
    {
        return $this->hasOne(MenorEdad::className(), ['id' => 'id_menor_edad']);
    }
}
