<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.establecimiento".
 *
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property integer $padre
 * @property integer $htipo
 * @property string $direccion
 * @property integer $hlocalidad
 * @property string $telefono
 * @property string $status
 * @property string $fechaoperacion
 * @property integer $hnivel
 * @property string $descripcion
 * @property string $x_utm
 * @property string $y_utm
 * @property string $altitud
 * @property integer $hasic
 * @property string $funcionamiento
 * @property integer $hdependencia_adm
 * @property string $nropersonas
 * @property integer $hejes
 * @property string $cantidadfamilia
 * @property string $icono
 * @property integer $ncamas
 * @property integer $camhip
 * @property integer $corposalud
 * @property integer $horario
 * @property string $usuario
 * @property string $rif
 * @property double $cuentadante
 * @property integer $htipo2
 * @property string $nombrelargo_comu
 * @property string $nombrelargo_trad
 *
 * @property Establecimiento $padre0
 * @property Establecimiento[] $establecimientos
 * @property Establecimiento $hasic0
 * @property Establecimiento[] $establecimientos0
 * @property Certificado[] $certificados
 */
class Establecimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogo.establecimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['padre', 'htipo', 'hlocalidad', 'hnivel', 'hasic', 'hdependencia_adm', 'hejes', 'ncamas', 'camhip', 'corposalud', 'horario', 'htipo2'], 'integer'],
            [['fechaoperacion'], 'safe'],
            [['descripcion'], 'string'],
            [['x_utm', 'y_utm', 'altitud', 'nropersonas', 'cantidadfamilia', 'cuentadante'], 'number'],
            [['codigo', 'rif'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 150],
            [['direccion'], 'string', 'max' => 250],
            [['telefono', 'icono'], 'string', 'max' => 50],
            [['status', 'funcionamiento'], 'string', 'max' => 1],
            [['usuario'], 'string', 'max' => 10],
            [['nombrelargo_comu', 'nombrelargo_trad'], 'string', 'max' => 500],
            [['padre'], 'exist', 'skipOnError' => true, 'targetClass' => Establecimiento::className(), 'targetAttribute' => ['padre' => 'id']],
            [['hasic'], 'exist', 'skipOnError' => true, 'targetClass' => Establecimiento::className(), 'targetAttribute' => ['hasic' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'padre' => 'Padre',
            'htipo' => 'Htipo',
            'direccion' => 'Direccion',
            'hlocalidad' => 'Hlocalidad',
            'telefono' => 'Telefono',
            'status' => 'Status',
            'fechaoperacion' => 'Fechaoperacion',
            'hnivel' => 'Hnivel',
            'descripcion' => 'Descripcion',
            'x_utm' => 'X Utm',
            'y_utm' => 'Y Utm',
            'altitud' => 'Altitud',
            'hasic' => 'Hasic',
            'funcionamiento' => 'Funcionamiento',
            'hdependencia_adm' => 'Hdependencia Adm',
            'nropersonas' => 'Nropersonas',
            'hejes' => 'Hejes',
            'cantidadfamilia' => 'Cantidadfamilia',
            'icono' => 'Icono',
            'ncamas' => 'Ncamas',
            'camhip' => 'Camhip',
            'corposalud' => 'Corposalud',
            'horario' => 'Horario',
            'usuario' => 'Usuario',
            'rif' => 'Rif',
            'cuentadante' => 'Cuentadante',
            'htipo2' => 'Htipo2',
            'nombrelargo_comu' => 'Nombrelargo Comu',
            'nombrelargo_trad' => 'Nombrelargo Trad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre0()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimientos()
    {
        return $this->hasMany(Establecimiento::className(), ['padre' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHasic0()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'hasic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimientos0()
    {
        return $this->hasMany(Establecimiento::className(), ['hasic' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificados()
    {
        return $this->hasMany(Certificado::className(), ['id_establecimiento' => 'id']);
    }
}
