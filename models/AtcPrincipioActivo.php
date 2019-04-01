<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.atc_principio_activo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $cod_pa
 * @property int $id_sq
 *
 * @property AtcSubgrupoQuimico $sq
 * @property Tratamiento[] $tratamientos
 */
class AtcPrincipioActivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.atc_principio_activo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'cod_pa', 'id_sq'], 'default', 'value' => null],
            [['nombre', 'cod_pa', 'id_sq'], 'required'],
            [['nombre'], 'string'],
            [['id_sq'], 'integer'],
            [['cod_pa'], 'string', 'max' => 2],
            [['id_sq'], 'exist', 'skipOnError' => true, 'targetClass' => AtcSubgrupoQuimico::className(), 'targetAttribute' => ['id_sq' => 'id']],
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
            'cod_pa' => Yii::t('app', 'Cod Pa'),
            'id_sq' => Yii::t('app', 'Id Sq'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSq()
    {
        return $this->hasOne(AtcSubgrupoQuimico::className(), ['id' => 'id_sq']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamiento::className(), ['id_atc_principio_activo' => 'id']);
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
      return $this->sq->codigoCompleto . $this->cod_pa;
    }

    public function getNombreCompleto()
    {

      return $this->codigoCompleto . ' '.$this->nombre;

    }
}
