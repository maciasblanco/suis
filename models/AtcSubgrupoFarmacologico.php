<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.atc_subgrupo_farmacologico".
 *
 * @property int $id
 * @property string $nombre
 * @property string $cod_sf
 * @property int $id_st
 *
 * @property AtcSubgrupoTerapeutico $st
 * @property AtcSubgrupoQuimico[] $atcSubgrupoQuimicos
 */
class AtcSubgrupoFarmacologico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.atc_subgrupo_farmacologico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'cod_sf', 'id_st'], 'default', 'value' => null],
            [['nombre', 'cod_sf', 'id_st'], 'required'],
            [['nombre'], 'string'],
            [['id_st'], 'integer'],
            [['cod_sf'], 'string', 'max' => 1],
            [['id_st'], 'exist', 'skipOnError' => true, 'targetClass' => AtcSubgrupoTerapeutico::className(), 'targetAttribute' => ['id_st' => 'id']],
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
            'cod_sf' => Yii::t('app', 'Cod Sf'),
            'id_st' => Yii::t('app', 'Id St'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSt()
    {
        return $this->hasOne(AtcSubgrupoTerapeutico::className(), ['id' => 'id_st']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtcSubgrupoQuimicos()
    {
        return $this->hasMany(AtcSubgrupoQuimico::className(), ['id_sf' => 'id']);
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
      
      return $this->st->codigoCompleto . $this->cod_sf;
    }
}
