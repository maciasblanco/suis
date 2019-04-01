<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "auditoria.h_preoperatorio".
 *
 * @property integer $id_usuario
 * @property integer $id_datos_personales
 * @property integer $id_preoperatorio
 * @property integer $id_estatus_preoperatorio
 * @property string $fecha
 * @property string $fecha_mod
 */
class HPreoperatorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auditoria.h_preoperatorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_datos_personales', 'id_preoperatorio', 'id_estatus_preoperatorio', 'fecha'], 'required'],
            [['id_usuario', 'id_datos_personales', 'id_preoperatorio', 'id_estatus_preoperatorio'], 'integer'],
            [['fecha', 'fecha_mod'], 'safe'],
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
            'id_preoperatorio' => 'Id Preoperatorio',
            'id_estatus_preoperatorio' => 'Id Estatus Preoperatorio',
            'fecha' => 'Fecha',
            'fecha_mod' => 'Fecha Mod',
        ];
    }

    public function getEstatusPreoperatorio()
    {
        return $this->hasone(\common\models\EstatusPreoperatorio::className(), ['id' => 'id_estatus_preoperatorio']);
    }
}
