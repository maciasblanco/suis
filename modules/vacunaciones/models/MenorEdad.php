<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "vacunacion.menor_edad".
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property int $id_representante
 * @property int $n_hijo
 * @property string $fecha_nac
 * @property int $id_sexo
 */
class MenorEdad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunacion.menor_edad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'id_representante', 'n_hijo', 'fecha_nac', 'id_sexo'], 'required'],
            [['id_representante', 'n_hijo', 'id_sexo'], 'default', 'value' => null],
            [['id_representante', 'n_hijo', 'id_sexo'], 'integer'],
            [['fecha_nac'], 'safe'],
            [['nombres', 'apellidos'], 'string', 'max' => 50],
            [['id_sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['id_sexo' => 'id']],
            [['id_representante'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersona::className(), 'targetAttribute' => ['id_representante' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'id_representante' => 'Id Representante',
            'n_hijo' => 'N Hijo',
            'fecha_nac' => 'Fecha Nac',
            'id_sexo' => 'Id Sexo',
        ];
    }
}
