<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cirugia.preoperatorio".
 *
 * @property integer $id
 * @property integer $id_estatus_preoperatorio
 * @property string $fecha_convocado
 * @property string $fecha_asistencia
 * @property integer $id_datos_personales
 *
 * @property DatosPersonales $idDatosPersonales
 */
class Preoperatorio extends \yii\db\ActiveRecord
{
    public $own_fecha;
    public $own_examenes;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.preoperatorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_estatus_preoperatorio', 'id_datos_personales', 'own_fecha'], 'required'],
            [['id_estatus_preoperatorio', 'id_datos_personales'], 'integer'],
            [['fecha_convocado', 'fecha_asistencia', 'own_fecha'], 'date', 'format'=>'php:d-m-Y'],
            [['fecha_convocado', 'fecha_asistencia', 'own_examenes'], 'safe'],
            [['id_datos_personales'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersonales::className(), 'targetAttribute' => ['id_datos_personales' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_estatus_preoperatorio' => 'Estatus Preoperatorio',
            'fecha_convocado' => 'Fecha Convocado',
            'fecha_asistencia' => 'Fecha Asistencia',
            'id_datos_personales' => 'Datos Personales',
            'own_fecha' => 'Fecha',
            'own_examenes' => 'Examenes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosPersonales()
    {
        return $this->hasOne(DatosPersonales::className(), ['id' => 'id_datos_personales']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatusPreoperatorio()
    {
        return $this->hasOne(\common\models\EstatusPreoperatorio::className(), ['id' => 'id_estatus_preoperatorio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamenesPreoperatorio()
    {
        return $this->hasMany(ExamenPreoperatorio::className(), ['id_preoperatorio' => 'id']); 
    }

    /**
     * After Find Object
     */
    public function afterfind(){
      parent::afterFind();

      if ($this->fecha_convocado != NULL)
        $this->fecha_convocado = date('d-m-Y', strtotime($this->fecha_convocado));

      if ($this->fecha_asistencia != NULL)
        $this->fecha_asistencia = date('d-m-Y', strtotime($this->fecha_asistencia));

      $examenes = ExamenPreoperatorio::find()->where(['id_preoperatorio'=>$this->id])->all();

      if (!empty($examenes)){
        foreach ($examenes as $exam){
          $this->own_examenes[] = $exam->id_examen;
        }
      }

      return TRUE;
    }

    public function getExamenesNomb($separador=', '){
      $ex = [];

      if (!empty($this->examenesPreoperatorio)){
        foreach ($this->examenesPreoperatorio as $exam){
          $ex[] = $exam->examen->nombre;
        }
      }
      
      return (empty($ex)) ? NULL : implode($separador, $ex);
    }
}
