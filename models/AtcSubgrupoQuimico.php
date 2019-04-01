<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.atc_subgrupo_quimico".
 *
 * @property int $id
 * @property string $nombre
 * @property string $cod_sq
 * @property int $id_sf
 *
 * @property AtcPrincipioActivo[] $atcPrincipioActivos
 * @property AtcSubgrupoFarmacologico $sf
 */
class AtcSubgrupoQuimico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.atc_subgrupo_quimico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'cod_sq', 'id_sf'], 'default', 'value' => null],
            [['nombre', 'cod_sq', 'id_sf'], 'required'],
            [['nombre'], 'string'],
            [['id_sf'], 'integer'],
            [['cod_sq'], 'string', 'max' => 1],
            [['id_sf'], 'exist', 'skipOnError' => true, 'targetClass' => AtcSubgrupoFarmacologico::className(), 'targetAttribute' => ['id_sf' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'cod_sq' => Yii::t('app', 'Cod Sq'),
            'id_sf' => Yii::t('app', 'Id Sf'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtcPrincipioActivos()
    {
        return $this->hasMany(AtcPrincipioActivo::className(), ['id_sq' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSf()
    {
        return $this->hasOne(AtcSubgrupoFarmacologico::className(), ['id' => 'id_sf']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }

    public function getCodigoCompleto()
    {
      
      return $this->sf->codigoCompleto . $this->cod_sq;
    }
}
