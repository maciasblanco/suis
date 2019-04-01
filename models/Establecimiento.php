<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.establecimiento".
 *
 * @property int $id
 * @property int $id_padre
 * @property string $codigo
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string $descripcion
 * @property double $longitud
 * @property double $latitud
 * @property string $rif
 * @property bool $funciona
 * @property int $id_tipo_establecimiento
 * @property string $codigo_estado
 * @property string $codigo_municipio
 * @property int $id_parroquia
 * @property int $id_comunidad
 * @property int $id_asic
 * @property int $id_dependencia_admin
 * @property bool $eliminado
 * @property string $id_anterior
 * @property int $estatus 1 => Activo 2 => Inactivo en morbilidad y programa 3 => Bloqueado 4 => Por aprobar
 *
 * @property Comunidad $comunidad
 * @property Establecimiento $padre
 * @property Establecimiento[] $establecimientos
 * @property Establecimiento $asic
 * @property Establecimiento[] $establecimientos0
 * @property Estado $codigoEstado
 * @property Municipio $codigoMunicipio
 * @property Parroquia $parroquia
 * @property TipoEstablecimiento $tipoEstablecimiento
 * @property Epi10[] $epi10s
 */
class Establecimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.establecimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_padre', 'codigo', 'nombre', 'direccion', 'telefono', 'descripcion', 'longitud', 'latitud', 'rif', 'funciona', 'id_tipo_establecimiento', 'codigo_estado', 'codigo_municipio', 'id_parroquia', 'id_comunidad', 'id_asic', 'id_dependencia_admin', 'eliminado', 'id_anterior', 'estatus'], 'default', 'value' => null],
            [['id_padre', 'id_tipo_establecimiento', 'id_parroquia', 'id_comunidad', 'id_asic', 'id_dependencia_admin', 'id_anterior', 'estatus'], 'integer'],
            [['codigo', 'nombre', 'codigo_estado'], 'required'],
            [['descripcion', 'codigo_estado', 'codigo_municipio'], 'string'],
            [['longitud', 'latitud'], 'number'],
            [['funciona', 'eliminado'], 'boolean'],
            [['codigo', 'rif'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 150],
            [['direccion'], 'string', 'max' => 250],
            [['telefono'], 'string', 'max' => 11],
            [['id_comunidad'], 'exist', 'skipOnError' => true, 'targetClass' => Comunidad::className(), 'targetAttribute' => ['id_comunidad' => 'id']],
            [['id_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Establecimiento::className(), 'targetAttribute' => ['id_padre' => 'id']],
            [['id_asic'], 'exist', 'skipOnError' => true, 'targetClass' => Establecimiento::className(), 'targetAttribute' => ['id_asic' => 'id']],
            [['codigo_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['codigo_estado' => 'codigo_estado']],
            [['codigo_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['codigo_municipio' => 'codigo_municipio']],
            [['id_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['id_parroquia' => 'id_parroquia']],
            [['id_tipo_establecimiento'], 'exist', 'skipOnError' => true, 'targetClass' => TipoEstablecimiento::className(), 'targetAttribute' => ['id_tipo_establecimiento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_padre' => Yii::t('app', 'Id Padre'),
            'codigo' => Yii::t('app', 'Codigo'),
            'nombre' => Yii::t('app', 'Nombre'),
            'direccion' => Yii::t('app', 'Direccion'),
            'telefono' => Yii::t('app', 'Telefono'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'longitud' => Yii::t('app', 'Longitud'),
            'latitud' => Yii::t('app', 'Latitud'),
            'rif' => Yii::t('app', 'Rif'),
            'funciona' => Yii::t('app', 'Funciona'),
            'id_tipo_establecimiento' => Yii::t('app', 'Id Tipo Establecimiento'),
            'codigo_estado' => Yii::t('app', 'Codigo Estado'),
            'codigo_municipio' => Yii::t('app', 'Codigo Municipio'),
            'id_parroquia' => Yii::t('app', 'Id Parroquia'),
            'id_comunidad' => Yii::t('app', 'Id Comunidad'),
            'id_asic' => Yii::t('app', 'Id Asic'),
            'id_dependencia_admin' => Yii::t('app', 'Id Dependencia Admin'),
            'eliminado' => Yii::t('app', 'Eliminado'),
            'id_anterior' => Yii::t('app', 'Id Anterior'),
            'estatus' => Yii::t('app', 'Estatus'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunidad()
    {
        return $this->hasOne(Comunidad::className(), ['id' => 'id_comunidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'id_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimientos()
    {
        return $this->hasMany(Establecimiento::className(), ['id_padre' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsic()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'id_asic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimientos0()
    {
        return $this->hasMany(Establecimiento::className(), ['id_asic' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoEstado()
    {
        return $this->hasOne(Estado::className(), ['codigo_estado' => 'codigo_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['codigo_municipio' => 'codigo_municipio']);
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
    public function getTipoEstablecimiento()
    {
        return $this->hasOne(TipoEstablecimiento::className(), ['id' => 'id_tipo_establecimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpi10s()
    {
        return $this->hasMany(Epi10::className(), ['id_establecimiento' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Retorna el nombre completo
     */
    public function getNombreCompleto()
    {
        return implode(' ', [
            $this->codigo,
            $this->nombre
        ]);
    }
}
