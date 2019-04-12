<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.tratamiento".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $concentracion
 * @property bool $lbme
 * @property int $id_forma_farmaceutica
 * @property int $id_atc_principio_activo
 *
 * @property AtcPrincipioActivo $atcPrincipioActivo
 * @property FormaFarmaceutica $formaFarmaceutica
 */
class Tratamiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.tratamiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'concentracion', 'lbme', 'id_forma_farmaceutica', 'id_atc_principio_activo'], 'default', 'value' => null],
            [['descripcion', 'id_atc_principio_activo'], 'required'],
            [['descripcion'], 'string'],
            [['lbme'], 'boolean'],
            [['id_forma_farmaceutica', 'id_atc_principio_activo'], 'integer'],
            [['concentracion'], 'string', 'max' => 100],
            [['id_atc_principio_activo'], 'exist', 'skipOnError' => true, 'targetClass' => AtcPrincipioActivo::className(), 'targetAttribute' => ['id_atc_principio_activo' => 'id']],
            [['id_forma_farmaceutica'], 'exist', 'skipOnError' => true, 'targetClass' => FormaFarmaceutica::className(), 'targetAttribute' => ['id_forma_farmaceutica' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'concentracion' => Yii::t('app', 'Concentracion'),
            'lbme' => Yii::t('app', 'Edo basico medicamento'),
            'id_forma_farmaceutica' => Yii::t('app', 'Forma Farmaceutica'),
            'id_atc_principio_activo' => Yii::t('app', 'Principio Activo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtcPrincipioActivo()
    {
        return $this->hasOne(AtcPrincipioActivo::className(), ['id' => 'id_atc_principio_activo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormaFarmaceutica()
    {
        return $this->hasOne(FormaFarmaceutica::className(), ['id' => 'id_forma_farmaceutica']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->descripcion;
    }

    /**
     *
     */
    public function getCodigoCompleto()
    {
      return $this->atcPrincipioActivo->cod_pa;
    }

    /**
     *
     */
    public function getConcentracionYForma()
    {
        return implode(' ', array_filter([
            $this->concentracion,
            $this->formaFarmaceutica,
        ]));
    }

    /**
     *
     */
    public function getNombreCompleto()
    {
        return implode(' ', array_filter([
            $this->descripcion,
            $this->concentracionYForma,
        ]));
    }
}
