<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.codificador".
 *
 * @property string $id
 * @property string $padre
 * @property string $codigo
 * @property double $reportaepi
 * @property string $nombre
 * @property double $epi
 * @property double $tele
 * @property double $hgrupo
 * @property double $reportatele
 * @property string $orden
 * @property string $ordenepi
 * @property int $evento_especial
 * @property int $sexo
 *
 * @property Diagnostico[] $diagnosticos
 * @property RenglonDiagnostico[] $renglonDiagnosticos
 * @property RenglonEpi10[] $renglonEpi10s
 * @property RenglonEvento[] $renglonEventos
 */
class Codificador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.codificador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['padre', 'evento_especial', 'sexo'], 'default', 'value' => null],
            [['padre', 'evento_especial', 'sexo'], 'integer'],
            [['codigo', 'nombre', 'epi', 'tele'], 'required'],
            [['reportaepi', 'epi', 'tele', 'hgrupo', 'reportatele', 'orden', 'ordenepi'], 'number'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 150],
            [['padre', 'codigo'], 'unique', 'targetAttribute' => ['padre', 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'padre' => 'Padre',
            'codigo' => 'Codigo',
            'reportaepi' => 'Reportaepi',
            'nombre' => 'Nombre',
            'epi' => 'Epi',
            'tele' => 'Tele',
            'hgrupo' => 'Hgrupo',
            'reportatele' => 'Reportatele',
            'orden' => 'Orden',
            'ordenepi' => 'Ordenepi',
            'evento_especial' => 'Evento Especial',
            'sexo' => 'Sexo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticos()
    {
        return $this->hasMany(Diagnostico::className(), ['id_diagnostico' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenglonDiagnosticos()
    {
        return $this->hasMany(RenglonDiagnostico::className(), ['hdiagnostico' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenglonEpi10s()
    {
        return $this->hasMany(RenglonEpi10::className(), ['hdiagnostico' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenglonEventos()
    {
        return $this->hasMany(RenglonEvento::className(), ['hcodificador' => 'id']);
    }
}
