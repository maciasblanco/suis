<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.caracteristica_condicion_caracteristica".
 *
 * @property int $id_caracteristica
 * @property int $id_condicion_caracteristica
 *
 * @property Caracteristica $caracteristica
 * @property CondicionCaracteristica $condicionCaracteristica
 */
class CaracteristicaCondicionCaracteristica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.caracteristica_condicion_caracteristica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_caracteristica', 'id_condicion_caracteristica'], 'default', 'value' => null],
            [['id_caracteristica', 'id_condicion_caracteristica'], 'required'],
            [['id_caracteristica', 'id_condicion_caracteristica'], 'integer'],
            [['id_caracteristica', 'id_condicion_caracteristica'], 'unique', 'targetAttribute' => ['id_caracteristica', 'id_condicion_caracteristica']],
            [['id_caracteristica'], 'exist', 'skipOnError' => true, 'targetClass' => Caracteristica::className(), 'targetAttribute' => ['id_caracteristica' => 'id']],
            [['id_condicion_caracteristica'], 'exist', 'skipOnError' => true, 'targetClass' => CondicionCaracteristica::className(), 'targetAttribute' => ['id_condicion_caracteristica' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_caracteristica' => Yii::t('app', 'Id Caracteristica'),
            'id_condicion_caracteristica' => Yii::t('app', 'Id Condicion Caracteristica'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaracteristica()
    {
        return $this->hasOne(Caracteristica::className(), ['id' => 'id_caracteristica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondicionCaracteristica()
    {
        return $this->hasOne(CondicionCaracteristica::className(), ['id' => 'id_condicion_caracteristica']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->id_caracteristica;
    }
}
