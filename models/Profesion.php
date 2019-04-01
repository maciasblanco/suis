<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.profesion".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $codigo_ine
 * @property int $id_padre
 * @property string $siglas
 * @property bool $eliminado
 *
 * @property Profesion $padre
 * @property Profesion[] $profesions
 * @property DatosEducacion[] $datosEducacions
 */
class Profesion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.profesion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'codigo_ine', 'id_padre', 'siglas', 'eliminado'], 'default', 'value' => null],
            [['codigo', 'nombre', 'codigo_ine'], 'required'],
            [['id_padre'], 'integer'],
            [['eliminado'], 'boolean'],
            [['codigo', 'codigo_ine'], 'string', 'max' => 15],
            [['nombre'], 'string', 'max' => 150],
            [['siglas'], 'string', 'max' => 6],
            [['codigo'], 'unique'],
            [['id_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Profesion::className(), 'targetAttribute' => ['id_padre' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codigo' => Yii::t('app', 'Codigo'),
            'nombre' => Yii::t('app', 'Nombre'),
            'codigo_ine' => Yii::t('app', 'Codigo Ine'),
            'id_padre' => Yii::t('app', 'Id Padre'),
            'siglas' => Yii::t('app', 'Siglas'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(Profesion::className(), ['id' => 'id_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfesions()
    {
        return $this->hasMany(Profesion::className(), ['id_padre' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosEducacions()
    {
        return $this->hasMany(DatosEducacion::className(), ['id_profesion' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }

    public function getCodigoNombre()
    {
        return $this->codigo.' '.$this->nombre;
    }
}
