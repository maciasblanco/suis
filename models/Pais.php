<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.pais".
 *
 * @property int $id
 * @property string $alfa2
 * @property string $alfa3
 * @property string $numerico
 * @property string $nombre_esp
 * @property string $nombre_ing
 * @property bool $eliminado
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.pais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alfa2', 'alfa3', 'numerico', 'nombre_esp', 'nombre_ing', 'eliminado'], 'default', 'value' => null],
            [['alfa2', 'alfa3', 'numerico', 'nombre_esp', 'nombre_ing'], 'required'],
            [['eliminado'], 'boolean'],
            [['alfa2'], 'string', 'max' => 2],
            [['alfa3', 'numerico'], 'string', 'max' => 3],
            [['nombre_esp', 'nombre_ing'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alfa2' => Yii::t('app', 'Alfa2'),
            'alfa3' => Yii::t('app', 'Alfa3'),
            'numerico' => Yii::t('app', 'Numerico'),
            'nombre_esp' => Yii::t('app', 'Nombre Esp'),
            'nombre_ing' => Yii::t('app', 'Nombre Ing'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre_esp;
    }
}
