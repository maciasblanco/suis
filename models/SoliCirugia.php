<?php

namespace frontend\models;

use common\models\Cirugia;
use Yii;

/**
 * This is the model class for table "cirugia.soli_cirugia".
 *
 * @property integer $id_datos_personales
 * @property integer $id_cirugia
 *
 * @property Cirugia $idCirugia
 * @property DatosPersonales $idDatosPersonales
 */
class SoliCirugia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.soli_cirugia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_datos_personales', 'id_cirugia'], 'required'],
            [['id_datos_personales', 'id_cirugia'], 'integer'],
            [['id_cirugia'], 'exist', 'skipOnError' => true, 'targetClass' => Cirugia::className(), 'targetAttribute' => ['id_cirugia' => 'id']],
            [['id_datos_personales'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersonales::className(), 'targetAttribute' => ['id_datos_personales' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_datos_personales' => 'Id Datos Personales',
            'id_cirugia' => 'Id Cirugia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirugia()
    {
        return $this->hasOne(Cirugia::className(), ['id' => 'id_cirugia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonales()
    {
        return $this->hasOne(DatosPersonales::className(), ['id' => 'id_datos_personales']);
    }
}
