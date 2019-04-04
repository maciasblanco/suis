<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general.datos_ubicacion".
 *
 * @property int $id
 * @property string $urbanizacion
 * @property string $avenida
 * @property string $nombre_residencia
 * @property string $num_residencia
 * @property string $num_piso
 * @property int $tiempo_residencia
 * @property string $casa
 * @property string $calle
 * @property int $id_unidad_tiempo
 * @property int $id_datos_persona
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $updated_ip
 *
 * @property UnidadTiempo $unidadTiempo
 * @property DatosPersona $datosPersona
 */
class DatosUbicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general.datos_ubicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['urbanizacion', 'avenida', 'nombre_residencia', 'num_residencia', 'num_piso', 'tiempo_residencia', 'casa', 'calle', 'id_unidad_tiempo', 'id_datos_persona', 'created_at', 'updated_at', 'created_by', 'updated_by', 'updated_ip'], 'default', 'value' => null],
            [['tiempo_residencia', 'id_unidad_tiempo', 'id_datos_persona', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['calle', 'updated_ip'], 'string'],
            [['urbanizacion'], 'string', 'max' => 100],
            [['avenida', 'nombre_residencia'], 'string', 'max' => 50],
            [['num_residencia'], 'string', 'max' => 8],
            [['num_piso'], 'string', 'max' => 3],
            [['casa'], 'string', 'max' => 150],
            [['id_unidad_tiempo'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadTiempo::className(), 'targetAttribute' => ['id_unidad_tiempo' => 'id']],
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
            'urbanizacion' => Yii::t('app', 'Urbanizacion'),
            'avenida' => Yii::t('app', 'Avenida'),
            'nombre_residencia' => Yii::t('app', 'Nombre Residencia'),
            'num_residencia' => Yii::t('app', 'Num Residencia'),
            'num_piso' => Yii::t('app', 'Num Piso'),
            'tiempo_residencia' => Yii::t('app', 'Tiempo Residencia'),
            'casa' => Yii::t('app', 'Casa'),
            'calle' => Yii::t('app', 'Calle'),
            'id_unidad_tiempo' => Yii::t('app', 'Id Unidad Tiempo'),
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
    public function getUnidadTiempo()
    {
        return $this->hasOne(UnidadTiempo::className(), ['id' => 'id_unidad_tiempo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersona()
    {
        return $this->hasOne(DatosPersona::className(), ['id' => 'id_datos_persona']);
    }
}
