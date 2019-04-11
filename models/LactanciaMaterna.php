<?php

namespace app\models;

use Yii;
use app\modules\epi10\models\DatosAtencion;

/**
 * This is the model class for table "catalogo.lactancia_materna".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $updated_ip
 *
 * @property DatosAtencion[] $datosAtencions
 */
class LactanciaMaterna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.lactancia_materna';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'created_at', 'updated_at', 'created_by', 'updated_by', 'updated_ip'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['updated_ip'], 'string'],
            [['descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
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
    public function getDatosAtencion()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_lactancia_materna' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
