<?php

namespace app\models;

use Yii;
use app\modules\epi10\models\DatosAtencion;

/**
 * This is the model class for table "catalogo.referencia_contrareferencia".
 *
 * @property int $id
 * @property string $descripcion
 * @property bool $eliminado
 *
 * @property DatosAtencion[] $datosAtencions
 * @property DatosAtencion[] $datosAtencions0
 */
class ReferenciaContrareferencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.referencia_contrareferencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'eliminado'], 'default', 'value' => null],
            [['descripcion'], 'required'],
            [['eliminado'], 'boolean'],
            [['descripcion'], 'string', 'max' => 50],
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
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosAtencionRef()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_referencia' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosAtencionContra()
    {
        return $this->hasMany(DatosAtencion::className(), ['id_contra_referencia' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
