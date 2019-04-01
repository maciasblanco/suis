<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "auditoria.h_personal".
 *
 * @property integer $id_usuario
 * @property string $tabla
 * @property integer $id_registro
 * @property string $valor_ant
 * @property string $valor_nvo
 * @property string $fecha_mod
 */
class HPersonal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auditoria.h_personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'tabla'], 'required'],
            [['id_usuario', 'id_registro'], 'integer'],
            [['tabla', 'valor_ant', 'valor_nvo'], 'string'],
            [['fecha_mod'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'tabla' => 'Tabla',
            'id_registro' => 'Id Registro',
            'valor_ant' => 'Valor Ant',
            'valor_nvo' => 'Valor Nvo',
            'fecha_mod' => 'Fecha Mod',
        ];
    }
}
