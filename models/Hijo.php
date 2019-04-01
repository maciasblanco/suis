<?php

namespace frontend\models;

use Yii;
use common\models\Nacionalidad;
use common\models\Sexo;

/**
 * This is the model class for table "sigca.datos_personales_hijo".
 *
 * @property integer $id
 * @property integer $id_nac
 * @property integer $hijo
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nac
 * @property integer $id_sexo
 * @property integer $id_padre
 *
 * @property CatalogoNacionalidad $idNac
 * @property CatalogoSexo $idSexo
 * @property SigcaDatosPersonales $idPadre
 */
class Hijo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sigca.datos_personales_hijo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nac', 'hijo', 'id_sexo', 'id_padre'], 'integer'],
            [['nombre', 'apellido'], 'string'],
            [['fecha_nac'], 'safe'],
            [['id_nac'], 'exist', 'skipOnError' => true, 'targetClass' => Nacionalidad::className(), 'targetAttribute' => ['id_nac' => 'id']],
            [['id_sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['id_sexo' => 'id']],
            [['id_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_padre' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nac' => 'Id Nac',
            'hijo' => 'Hijo',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'fecha_nac' => 'Fecha Nac',
            'id_sexo' => 'Id Sexo',
            'id_padre' => 'Id Padre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNac()
    {
        return $this->hasOne(CatalogoNacionalidad::className(), ['id' => 'id_nac']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSexo()
    {
        return $this->hasOne(CatalogoSexo::className(), ['id' => 'id_sexo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPadre()
    {
        return $this->hasOne(SigcaDatosPersonales::className(), ['id' => 'id_padre']);
    }
}
