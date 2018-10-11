<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.tipo_establecimiento".
 *
 * @property integer $id
 * @property integer $padre
 * @property string $codigo
 * @property string $nombre
 * @property string $descripcion
 * @property string $usuario
 * @property string $fechaoperacion
 * @property double $hnivel
 * @property integer $estatus
 *
 * @property Certificado[] $certificados
 */
class TipoEstablecimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.tipo_establecimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['padre', 'estatus'], 'integer'],
            [['fechaoperacion'], 'safe'],
            [['hnivel'], 'number'],
            [['codigo'], 'string', 'max' => 15],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 250],
            [['usuario'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'padre' => 'Padre',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'usuario' => 'Usuario',
            'fechaoperacion' => 'Fechaoperacion',
            'hnivel' => 'Hnivel',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['id_establecimiento' => 'id']);
    }
}
