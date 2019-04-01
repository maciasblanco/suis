<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.atc_subgrupo_terapeutico".
 *
 * @property int $id
 * @property string $cod_st
 * @property string $nombre
 * @property string $id_na
 *
 * @property AtcSubgrupoFarmacologico[] $atcSubgrupoFarmacologicos
 * @property AtcNivelAnatomico $na
 */
class AtcSubgrupoTerapeutico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.atc_subgrupo_terapeutico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_st', 'nombre', 'id_na'], 'default', 'value' => null],
            [['cod_st', 'nombre', 'id_na'], 'required'],
            [['nombre', 'id_na'], 'string'],
            [['cod_st'], 'string', 'max' => 2],
            [['id_na'], 'exist', 'skipOnError' => true, 'targetClass' => AtcNivelAnatomico::className(), 'targetAttribute' => ['id_na' => 'cod_na']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cod_st' => Yii::t('app', 'Cod St'),
            'nombre' => Yii::t('app', 'Nombre'),
            'id_na' => Yii::t('app', 'Id Na'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtcSubgrupoFarmacologicos()
    {
        return $this->hasMany(AtcSubgrupoFarmacologico::className(), ['id_st' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNa()
    {
        return $this->hasOne(AtcNivelAnatomico::className(), ['cod_na' => 'id_na']);
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
      return $this->na->cod_na . $this->cod_st;
    }
}
