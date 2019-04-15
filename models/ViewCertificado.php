<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ev25.view_certificado".
 *
 * @property string $establecimiento
 * @property string $num_historia
 * @property string $centro
 * @property string $estado
 * @property string $municipio
 * @property string $parroquia
 * @property string $avenida
 * @property string $cedula madre
 * @property string $seria carnet madre
 * @property string $nombre madre
 * @property string $apellido madre
 * @property string $fecha nacimiento madre
 * @property string $edad madre
 * @property string $edo_civil madre
 * @property string $anios casados madre
 * @property string $numero nacidos madre
 * @property string $numeros vivos madre
 * @property string $numeros fallecidos madre
 * @property string $muerte fetales
 * @property bool $consultas madre
 * @property string $tipo de embarazo
 * @property string $tipo de parto
 * @property string $tipo partero
 * @property string $nivel educativo madre
 * @property string $ocupacion madre
 * @property string $profesion madre
 * @property string $etnia madre
 * @property bool $idioma indigena madre
 * @property string $nacionalidad
 * @property string $tipo de documento
 * @property string $num_consulta
 * @property string $lugar de nacimiento madre
 * @property string $estado de nacimiento
 * @property string $ avenida madre
 * @property string $ edif madre
 * @property string $ piso madre
 * @property string $ apartamento madre
 * @property string $ urbanizacion madre
 * @property string $cant_hijos
 * @property string $comunidad
 * @property string $cedula padre
 * @property string $seria carnet padre
 * @property string $nombre padre
 * @property string $apellido padre
 * @property string $fecha nacimiento padre
 * @property string $edad padre
 * @property string $edo_civil padre
 * @property string $anios casados padre
 * @property string $nivel educativo padre
 * @property string $ocupacion padre
 * @property string $profesion padre
 * @property string $etnia padre padre
 * @property bool $idioma indigena padre
 * @property string $nacionalidad padre
 * @property string $tipo de documento padre
 * @property string $lugar de nacimiento padre
 * @property string $estado de nacimiento padre
 * @property string $avenida padre
 * @property string $edif padre
 * @property string $piso padre
 * @property string $apartamento padre
 * @property string $urbanizacion padre
 * @property string $comunidad padre
 * @property string $fecha
 * @property string $hora
 * @property int $semana_gestacion
 * @property double $talla
 * @property double $peso
 * @property int $cedula medico
 * @property int $registro sanitario medico
 * @property string $nombre del medico
 * @property string $sexo niñ@
 * @property string $nombre niñ@
 * @property string $apellido niñ@
 * @property string $nombre_malf_cong
 * @property string $codigo_unico
 * @property string $observaciones
 * @property string $username
 */
class ViewCertificado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ev25.view_certificado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_historia', 'centro', 'avenida', 'cedula madre', 'nombre madre', 'apellido madre', 'tipo de embarazo', 'lugar de nacimiento madre', ' avenida madre', ' apartamento madre', ' urbanizacion madre', 'comunidad', 'cedula padre', 'nombre padre', 'apellido padre', 'lugar de nacimiento padre', 'avenida padre', 'apartamento padre', 'urbanizacion padre', 'comunidad padre', 'nombre niñ@', 'apellido niñ@', 'nombre_malf_cong', 'codigo_unico', 'observaciones'], 'string'],
            [['seria carnet madre', 'edad madre', 'anios casados madre', 'numero nacidos madre', 'numeros vivos madre', 'numeros fallecidos madre', 'muerte fetales', 'num_consulta', ' piso madre', 'cant_hijos', 'seria carnet padre', 'edad padre', 'anios casados padre', 'piso padre', 'talla', 'peso'], 'number'],
            [['fecha nacimiento madre', 'fecha nacimiento padre', 'fecha', 'hora'], 'safe'],
            [['consultas madre', 'idioma indigena madre', 'idioma indigena padre'], 'boolean'],
            [['semana_gestacion', 'cedula medico', 'registro sanitario medico'], 'default', 'value' => null],
            [['semana_gestacion', 'cedula medico', 'registro sanitario medico'], 'integer'],
            [['establecimiento', 'profesion madre', 'etnia madre', ' edif madre', 'profesion padre', 'etnia padre padre', 'edif padre', 'nombre del medico'], 'string', 'max' => 150],
            [['estado', 'municipio', 'parroquia', 'edo_civil madre', 'tipo de parto', 'tipo partero', 'nivel educativo madre', 'nacionalidad', 'tipo de documento', 'estado de nacimiento', 'edo_civil padre', 'nivel educativo padre', 'nacionalidad padre', 'tipo de documento padre', 'estado de nacimiento padre'], 'string', 'max' => 50],
            [['ocupacion madre', 'ocupacion padre'], 'string', 'max' => 250],
            [['sexo niñ@'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'establecimiento' => 'Establecimiento',
            'num_historia' => 'Num Historia',
            'centro' => 'Centro',
            'estado' => 'Estado',
            'municipio' => 'Municipio',
            'parroquia' => 'Parroquia',
            'avenida' => 'Avenida',
            'cedula madre' => 'Cedula Madre',
            'seria carnet madre' => 'Seria Carnet Madre',
            'nombre madre' => 'Nombre Madre',
            'apellido madre' => 'Apellido Madre',
            'fecha nacimiento madre' => 'Fecha Nacimiento Madre',
            'edad madre' => 'Edad Madre',
            'edo_civil madre' => 'Edo Civil Madre',
            'anios casados madre' => 'Anios Casados Madre',
            'numero nacidos madre' => 'Numero Nacidos Madre',
            'numeros vivos madre' => 'Numeros Vivos Madre',
            'numeros fallecidos madre' => 'Numeros Fallecidos Madre',
            'muerte fetales' => 'Muerte Fetales',
            'consultas madre' => 'Consultas Madre',
            'tipo de embarazo' => 'Tipo De Embarazo',
            'tipo de parto' => 'Tipo De Parto',
            'tipo partero' => 'Tipo Partero',
            'nivel educativo madre' => 'Nivel Educativo Madre',
            'ocupacion madre' => 'Ocupacion Madre',
            'profesion madre' => 'Profesion Madre',
            'etnia madre' => 'Etnia Madre',
            'idioma indigena madre' => 'Idioma Indigena Madre',
            'nacionalidad' => 'Nacionalidad',
            'tipo de documento' => 'Tipo De Documento',
            'num_consulta' => 'Num Consulta',
            'lugar de nacimiento madre' => 'Lugar De Nacimiento Madre',
            'estado de nacimiento' => 'Estado De Nacimiento',
            ' avenida madre' => 'Avenida Madre',
            ' edif madre' => 'Edif Madre',
            ' piso madre' => 'Piso Madre',
            ' apartamento madre' => 'Apartamento Madre',
            ' urbanizacion madre' => 'Urbanizacion Madre',
            'cant_hijos' => 'Cant Hijos',
            'comunidad' => 'Comunidad',
            'cedula padre' => 'Cedula Padre',
            'seria carnet padre' => 'Seria Carnet Padre',
            'nombre padre' => 'Nombre Padre',
            'apellido padre' => 'Apellido Padre',
            'fecha nacimiento padre' => 'Fecha Nacimiento Padre',
            'edad padre' => 'Edad Padre',
            'edo_civil padre' => 'Edo Civil Padre',
            'anios casados padre' => 'Anios Casados Padre',
            'nivel educativo padre' => 'Nivel Educativo Padre',
            'ocupacion padre' => 'Ocupacion Padre',
            'profesion padre' => 'Profesion Padre',
            'etnia padre padre' => 'Etnia Padre Padre',
            'idioma indigena padre' => 'Idioma Indigena Padre',
            'nacionalidad padre' => 'Nacionalidad Padre',
            'tipo de documento padre' => 'Tipo De Documento Padre',
            'lugar de nacimiento padre' => 'Lugar De Nacimiento Padre',
            'estado de nacimiento padre' => 'Estado De Nacimiento Padre',
            'avenida padre' => 'Avenida Padre',
            'edif padre' => 'Edif Padre',
            'piso padre' => 'Piso Padre',
            'apartamento padre' => 'Apartamento Padre',
            'urbanizacion padre' => 'Urbanizacion Padre',
            'comunidad padre' => 'Comunidad Padre',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
            'semana_gestacion' => 'Semana Gestacion',
            'talla' => 'Talla',
            'peso' => 'Peso',
            'cedula medico' => 'Cedula Medico',
            'registro sanitario medico' => 'Registro Sanitario Medico',
            'nombre del medico' => 'Nombre Del Medico',
            'sexo niñ@' => 'Sexo Niñ@',
            'nombre niñ@' => 'Nombre Niñ@',
            'apellido niñ@' => 'Apellido Niñ@',
            'nombre_malf_cong' => 'Nombre Malf Cong',
            'codigo_unico' => 'Codigo Unico',
            'observaciones' => 'Observaciones',
            'username' => 'Username',
        ];
    }
}
