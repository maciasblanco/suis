<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.institucion_formadora".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $observacion
 * @property bool $eliminado
 */
class InstitucionFormadora extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.institucion_formadora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'observacion', 'eliminado'], 'default', 'value' => null],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 200],
            [['observacion'], 'string', 'max' => 250],
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
            'observacion' => Yii::t('app', 'Observacion'),
            'eliminado' => Yii::t('app', 'Eliminado'),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }
}
