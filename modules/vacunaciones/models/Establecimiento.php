<?php

namespace app\modules\vacunaciones\models;

use Yii;

/**
 * This is the model class for table "catalogo.establecimiento".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property int $padre
 * @property int $htipo
 * @property string $direccion
 * @property int $hlocalidad
 * @property string $telefono Municipios,Parroquia
 * @property string $status
 * @property string $fechaoperacion
 * @property int $hnivel
 * @property string $descripcion
 * @property string $x_utm
 * @property string $y_utm
 * @property string $altitud
 * @property int $hasic relacion  con asic
 * @property string $funcionamiento
 * @property int $hdependencia_adm
 * @property string $nropersonas Nro de Persona de Refugio
 * @property int $hejes relacion con los ejes
 * @property string $cantidadfamilia familia en los refugios
 * @property string $icono Imagen para mapas
 * @property int $ncamas Nro de Camas de Centros
 * @property int $camhip Nro camaras hiperbaricas
 * @property int $corposalud 1 Pertenece 0 No pertenece
 * @property int $horario Horario del establecimiento 6=6h,  8=8h,  12=12h y 24=24 h
 * @property string $usuario
 * @property string $rif
 * @property double $cuentadante
 * @property int $htipo2
 * @property string $nombrelargo_comu
 * @property string $nombrelargo_trad
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
            [['padre', 'htipo', 'hlocalidad', 'hnivel', 'hasic', 'hdependencia_adm', 'hejes', 'ncamas', 'camhip', 'corposalud', 'horario', 'htipo2'], 'default', 'value' => null],
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
     * {@inheritdoc}
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
}
