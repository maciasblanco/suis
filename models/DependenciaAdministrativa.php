<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.dependencia_administrativa".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property bool $eliminado
 */
class DependenciaAdministrativa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.dependencia_administrativa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'eliminado'], 'default', 'value' => null],
            [['eliminado'], 'boolean'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 150],
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
