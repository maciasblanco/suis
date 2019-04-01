<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "auditoria.h_cirugia".
 *
 * @property integer $id_usuario
 * @property integer $id_datos_personales
 * @property integer $id_cirugia
 * @property string $operacion
 */
class HCirugia extends \yii\db\ActiveRecord
{
    const OPE_REG = 'R';
    const OPE_ELIM = 'E';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auditoria.h_cirugia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_datos_personales', 'id_cirugia'], 'required'],
            [['id_usuario', 'id_datos_personales', 'id_cirugia'], 'integer'],
            [['operacion'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_datos_personales' => 'Id Datos Personales',
            'id_cirugia' => 'Id Cirugia',
            'operacion' => 'Operacion',
        ];
    }
}
