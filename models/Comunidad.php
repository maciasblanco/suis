<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.comunidad".
 *
 * @property int $id
 * @property string $codigo_comunidad
 * @property string $comunidad
 * @property int $id_parroquia
 * @property int $cant_casas
 * @property int $poblacion
 * @property bool $eliminado
 *
 * @property Parroquia $parroquia
 * @property Establecimiento[] $establecimientos
 * @property DatosPersona[] $datosPersonas
 */
class Comunidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.comunidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_comunidad', 'comunidad', 'id_parroquia', 'cant_casas', 'poblacion', 'eliminado'], 'default', 'value' => null],
            [['comunidad'], 'string'],
            [['id_parroquia', 'cant_casas', 'poblacion'], 'integer'],
            [['eliminado'], 'boolean'],
            [['codigo_comunidad'], 'string', 'max' => 20],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codigo_comunidad' => Yii::t('app', 'Codigo Comunidad'),
            'comunidad' => Yii::t('app', 'Comunidad'),
            'id_parroquia' => Yii::t('app', 'Id Parroquia'),
            'cant_casas' => Yii::t('app', 'Cant Casas'),
            'poblacion' => Yii::t('app', 'Poblacion'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id_parroquia' => 'id_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimientos()
    {
        return $this->hasMany(Establecimiento::className(), ['id_comunidad' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonas()
    {
        return $this->hasMany(DatosPersona::className(), ['id_comunidad' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->comunidad;
    }
}
