<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cirugia.carnet_patria".
 *
 * @property integer $id
 * @property integer $id_datos_personales
 * @property string $apellidos
 * @property string $nombres
 * @property string $movil1
 * @property string $fecha_nacimiento
 * @property string $estado
 * @property string $municipio
 * @property string $parroquia
 * @property string $casa
 * @property string $calle
 * @property string $bloque
 * @property string $urbanismo
 * @property string $sector_barrio
 *
 * @property DatosPersonales $idDatosPersonales
 */
class CarnetPatria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.carnet_patria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_datos_personales'], 'integer'],
            [['apellidos', 'nombres', 'movil1', 'estado', 'municipio', 'parroquia', 'casa', 'calle', 'bloque', 'urbanismo', 'sector_barrio'], 'string'],
            [['fecha_nacimiento'], 'safe'],
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
            'id_datos_personales' => 'Id Datos Personales',
            'apellidos' => 'Apellido',
            'nombres' => 'Nombre',
            'movil1' => 'Movil1',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'estado' => 'Estado',
            'municipio' => 'Municipio',
            'parroquia' => 'Parroquia',
            'casa' => 'Casa',
            'calle' => 'Calle',
            'bloque' => 'Bloque',
            'urbanismo' => 'Urbanismo',
            'sector_barrio' => 'Sector Barrio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonales()
    {
        return $this->hasOne(DatosPersonales::className(), ['id' => 'id_datos_personales']);
    }
}

