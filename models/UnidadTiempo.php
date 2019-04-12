<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.unidad_tiempo".
 *
 * @property int $id
 * @property string $unidad
 * @property int $equivalencia
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $updated_ip
 *
 * @property DatosUbicacion[] $datosUbicacions
 */
class UnidadTiempo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.unidad_tiempo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unidad', 'equivalencia', 'created_at', 'updated_at', 'created_by', 'updated_by', 'updated_ip'], 'default', 'value' => null],
            [['equivalencia', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['updated_ip'], 'string'],
            [['unidad'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unidad' => Yii::t('app', 'Unidad'),
            'equivalencia' => Yii::t('app', 'Equivalencia'),
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
    public function getDatosUbicacions()
    {
        return $this->hasMany(DatosUbicacion::className(), ['id_unidad_tiempo' => 'id']);
    }
}
