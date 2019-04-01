<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.atc_nivel_anatomico".
 *
 * @property string $cod_na
 * @property string $nombre
 *
 * @property AtcSubgrupoTerapeutico[] $atcSubgrupoTerapeuticos
 */
class AtcNivelAnatomico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.atc_nivel_anatomico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_na', 'nombre'], 'default', 'value' => null],
            [['cod_na'], 'required'],
            [['nombre'], 'string'],
            [['cod_na'], 'string', 'max' => 1],
            [['cod_na'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cod_na' => Yii::t('app', 'Cod Na'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtcSubgrupoTerapeuticos()
    {
        return $this->hasMany(AtcSubgrupoTerapeutico::className(), ['id_na' => 'cod_na']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }

}
