<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.tipo_diagnostico".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Diagnostico[] $diagnosticos
 */
class TipoDiagnostico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.tipo_diagnostico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpi10Diagnosticos()
    {
        return $this->hasMany(\app\modules\epi10\models\Diagnostico::className(), ['id_tipo_diagnostico' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }
}
