<?php

namespace frontend\models;

use Yii;
use common\models\Examen;

/**
 * This is the model class for table "cirugia.examen_preoperatorio".
 *
 * @property integer $id_examen
 * @property integer $id_preoperatorio
 *
 * @property Examen $idExamen
 * @property Preoperatorio $idPreoperatorio
 */
class ExamenPreoperatorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.examen_preoperatorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_examen', 'id_preoperatorio'], 'required'],
            [['id_examen', 'id_preoperatorio'], 'integer'],
            [['id_examen'], 'exist', 'skipOnError' => true, 'targetClass' => Examen::className(), 'targetAttribute' => ['id_examen' => 'id']],
            [['id_preoperatorio'], 'exist', 'skipOnError' => true, 'targetClass' => Preoperatorio::className(), 'targetAttribute' => ['id_preoperatorio' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_examen' => 'Id Examen',
            'id_preoperatorio' => 'Id Preoperatorio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamen()
    {
        return $this->hasOne(Examen::className(), ['id' => 'id_examen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPreoperatorio()
    {
        return $this->hasOne(Preoperatorio::className(), ['id' => 'id_preoperatorio']);
    }
}
