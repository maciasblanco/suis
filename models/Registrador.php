<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cirugia.registrador".
 *
 * @property integer $id
 * @property string $medico
 * @property integer $tlf_medico
 * @property string $enfermera
 * @property integer $tlf_enfermera
 * @property string $promo_salud
 * @property integer $tlf_promo_salud
 * @property string $ubch
 * @property integer $tlf_ubch
 * @property string $regional
 * @property integer $tlf_regional
 * @property string $vice_mujer
 * @property integer $tlf_vice_mujer
 * @property integer $id_datos_personales
 *
 * @property DatosPersonales $idDatosPersonales
 */
class Registrador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.registrador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_datos_personales'], 'required'],
            [['medico', 'enfermera', 'promo_salud', 'ubch', 'regional', 'vice_mujer', 'clap', 'tlf_medico', 'tlf_enfermera', 'tlf_promo_salud', 'tlf_ubch', 'tlf_regional', 'tlf_vice_mujer', 'tlf_clap'], 'default', 'value'=>NULL],
            [['medico', 'enfermera', 'promo_salud', 'ubch', 'regional', 'vice_mujer', 'clap'], 'string'],
            [['id_datos_personales'], 'integer'],
            [['tlf_medico', 'tlf_enfermera', 'tlf_promo_salud', 'tlf_ubch', 'tlf_regional', 'tlf_vice_mujer', 'tlf_clap'], 'match', 'pattern'=>'/^0\d{10}$/', 'message'=>'El número de teléfono debe tener 11 caracteres numéricos, incluyendo el 0 inicial.'],
            [['id_datos_personales'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersonales::className(), 'targetAttribute' => ['id_datos_personales' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medico' => 'Medico',
            'tlf_medico' => 'Tlf Medico',
            'enfermera' => 'Enfermera',
            'tlf_enfermera' => 'Tlf Enfermera',
            'promo_salud' => 'Promotor Salud',
            'tlf_promo_salud' => 'Tlf Promotor Salud',
            'ubch' => 'UBCH y/o CLP',
            'tlf_ubch' => 'Tlf UBCH y/o CLP',
            'regional' => 'Representante Regional Salud',
            'tlf_regional' => 'Tlf Representante Regional Salud',
            'vice_mujer' => 'Vicepresidencia Mujer PSUV',
            'tlf_vice_mujer' => 'Tlf Vicepresidencia Mujer PSUV',
            'id_datos_personales' => 'Id Datos Personales',
            'clap' => 'Jefe CLAP',
            'tlf_clap' => 'Tlf Jefe CLAP',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosPersonales()
    {
        return $this->hasOne(DatosPersonales::className(), ['id' => 'id_datos_personales']);
    }
}
