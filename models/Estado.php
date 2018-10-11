<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.estado".
 *
 * @property string $codigo_estado
 * @property string $estado
 *
 * @property Municipio[] $municipios
 * @property Municipio[] $municipios0
 * @property DatosRepresentante[] $datosRepresentantes
 * @property Certificado[] $certificados
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.estado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_estado'], 'required'],
            [['codigo_estado'], 'string', 'max' => 2],
            [['estado'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo_estado' => 'Codigo Estado',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipio::className(), ['codigo_estado' => 'codigo_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios0()
    {
        return $this->hasMany(Municipio::className(), ['codigo_estado' => 'codigo_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosRepresentantes()
    {
        return $this->hasMany(DatosRepresentante::className(), ['codigo_estado' => 'codigo_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['codigo_estado' => 'codigo_estado']);
    }
}
