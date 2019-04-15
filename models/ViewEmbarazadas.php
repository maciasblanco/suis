<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sicasmi.view_embarazadas".
 *
 * @property string $cedula
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $discapacidad
 * @property string $tipo embarazo
 * @property bool $riesgo
 * @property bool $primeriza
 * @property string $tlfcelular
 * @property string $tlflocal
 * @property string $tlfotro
 * @property bool $estatus
 * @property int $n_embarazo
 * @property string $fpp
 * @property bool $control_prenatal
 * @property bool $asic_territorio
 * @property bool $programa_parto_organizado
 * @property string $ultima_regla
 * @property string $etnia
 * @property string $antecedente_obstetrico_np
 * @property string $antecedente_obstetrico_nc
 * @property string $antecedente_obstetrico_na
 * @property string $tiempo_embarazo_momento_consulta
 * @property string $donde
 * @property bool $micronutrientes
 * @property int $enfermedad_asociada
 * @property string $usuario
 */
class ViewEmbarazadas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sicasmi.view_embarazadas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'antecedente_obstetrico_np', 'antecedente_obstetrico_nc', 'antecedente_obstetrico_na'], 'number'],
            [['riesgo', 'primeriza', 'estatus', 'control_prenatal', 'asic_territorio', 'programa_parto_organizado', 'micronutrientes'], 'boolean'],
            [['n_embarazo', 'enfermedad_asociada'], 'default', 'value' => null],
            [['n_embarazo', 'enfermedad_asociada'], 'integer'],
            [['fpp', 'ultima_regla'], 'safe'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'discapacidad', 'donde'], 'string', 'max' => 50],
            [['tipo embarazo', 'tlfotro'], 'string', 'max' => 45],
            [['tlfcelular', 'tlflocal'], 'string', 'max' => 12],
            [['etnia'], 'string', 'max' => 150],
            [['tiempo_embarazo_momento_consulta'], 'string', 'max' => 40],
            [['usuario'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cedula' => 'Cedula',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'discapacidad' => 'Discapacidad',
            'tipo embarazo' => 'Tipo Embarazo',
            'riesgo' => 'Riesgo',
            'primeriza' => 'Primeriza',
            'tlfcelular' => 'Tlfcelular',
            'tlflocal' => 'Tlflocal',
            'tlfotro' => 'Tlfotro',
            'estatus' => 'Estatus',
            'n_embarazo' => 'N Embarazo',
            'fpp' => 'Fpp',
            'control_prenatal' => 'Control Prenatal',
            'asic_territorio' => 'Asic Territorio',
            'programa_parto_organizado' => 'Programa Parto Organizado',
            'ultima_regla' => 'Ultima Regla',
            'etnia' => 'Etnia',
            'antecedente_obstetrico_np' => 'Antecedente Obstetrico Np',
            'antecedente_obstetrico_nc' => 'Antecedente Obstetrico Nc',
            'antecedente_obstetrico_na' => 'Antecedente Obstetrico Na',
            'tiempo_embarazo_momento_consulta' => 'Tiempo Embarazo Momento Consulta',
            'donde' => 'Donde',
            'micronutrientes' => 'Micronutrientes',
            'enfermedad_asociada' => 'Enfermedad Asociada',
            'usuario' => 'Usuario',
        ];
    }
}
