<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general.datos_contacto".
 *
 * @property int $id
 * @property string $telefono_habitacion
 * @property string $telefono_movil
 * @property string $telefono_otro
 * @property string $correo
 * @property string $twitter
 * @property string $instagram
 * @property string $facebook
 * @property int $id_datos_persona
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $updated_ip
 *
 * @property DatosPersona $datosPersona
 */
class DatosContacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general.datos_contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono_habitacion', 'telefono_movil', 'telefono_otro', 'correo', 'twitter', 'instagram', 'facebook', 'id_datos_persona', 'created_at', 'updated_at', 'created_by', 'updated_by', 'updated_ip'], 'default', 'value' => null],
            [['id_datos_persona', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['updated_ip'], 'string'],
            [['telefono_habitacion', 'telefono_movil', 'telefono_otro'], 'string', 'max' => 11],
            [['correo'], 'string', 'max' => 70],
            [['twitter', 'instagram', 'facebook'], 'string', 'max' => 30],
            [['id_datos_persona'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersona::className(), 'targetAttribute' => ['id_datos_persona' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'telefono_habitacion' => Yii::t('app', 'Telefono Habitacion'),
            'telefono_movil' => Yii::t('app', 'Telefono Movil'),
            'telefono_otro' => Yii::t('app', 'Telefono Otro'),
            'correo' => Yii::t('app', 'Correo'),
            'twitter' => Yii::t('app', 'Twitter'),
            'instagram' => Yii::t('app', 'Instagram'),
            'facebook' => Yii::t('app', 'Facebook'),
            'id_datos_persona' => Yii::t('app', 'Id Datos Persona'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_ip' => Yii::t('app', 'Updated Ip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersona()
    {
        return $this->hasOne(DatosPersona::className(), ['id' => 'id_datos_persona']);
    }
}
