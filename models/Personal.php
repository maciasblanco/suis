<?php

namespace frontend\models;

use Yii;
use common\models\Nacionalidad;
use common\models\Parroquia;
use common\models\Sexo;

/**
 * This is the model class for table "sigca.datos_personales".
 *
 * @property integer $id
 * @property integer $id_nac
 * @property integer $cedula
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nac
 * @property integer $id_sexo
 * @property integer $id_parroquia
 * @property string $tlf_cel
 * @property string $tlf_local
 * @property integer $id_padre
 * @property integer $hijo
 * @property string $direccion
 * @property string $foto
 *
 * @property Nacionalidad $idNac
 * @property Parroquia $idParroquia
 * @property Sexo $idSexo
 * @property DatosPersonalesHijo[] $datosPersonalesHijos
 * @property Ficha[] $fichas
 */
class Personal extends \yii\db\ActiveRecord
{
  //public $own_edo_search;
  public $own_cirugias;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.datos_personales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['nombre', 'apellido', 'id_sexo', 'cedula', 'carnet', 'clap', 'enfermedad_cronica', 'own_cirugias'], 'required', 'except'=>['reporte']],
          [['activo', 'carnet', 'clap', 'enfermedad_cronica', 'confirmado_carnet'], 'boolean'],
          [['id_nac', 'id_sexo', 'id_padre', 'hijo', 'id_usuario','operado'], 'integer'],
          [['nombre', 'apellido', 'cedula', 'nombre_enfermedad', 'cod_carnet', 'nombre_clap', 'otras_cirugias', 'codigo'], 'default', 'value'=>NULL],
          [['nombre', 'apellido', 'cedula', 'nombre_enfermedad', 'cod_carnet', 'nombre_clap', 'otras_cirugias', 'codigo'], 'string'],
          [['fecha_validado','fecha_operado'], 'date', 'format'=>'php:d-m-Y'],
          [['validar'], 'boolean'],
          [['activo','fecha_nac', 'id_parroquia', 'direccion'], 'safe'],
          [['fecha_nac'], 'date', 'format'=>'php:d-m-Y', 'max'=>date('d-m-Y')],
          [['cedula'], 'unique', 'targetAttribute' => ['cedula', 'hijo'], 'message' => 'Eĺ número de hijo ya existe para este número de cédula.'],
          [['cedula'], 'match', 'pattern'=>'/^[1-9]\d{5,7}$/', 'message'=>'La cédula debe tener de 6 a 8 caracteres numéricos.'],
          [['id_nac'], 'exist', 'skipOnError' => true, 'targetClass' => Nacionalidad::className(), 'targetAttribute' => ['id_nac' => 'id']],
          [['id_sexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['id_sexo' => 'id']],
          [['nombre_enfermedad'], 'required', 'when'=>function($model){
              return $model->enfermedad_cronica == TRUE;
            }, 'whenClient'=>'function(attribute, value){
              return $("#personal-enfermedad_cronica").val() == 1;
            }'],
          [['otras_cirugias'], 'required', 'when'=>function($model){
            return in_array(24, $model->own_cirugias);
          }, 'whenClient'=>'function(attribute, value){
            return $.inArray("24", $("#cirugia").val()) != -1;
          }'],
          [['hijo'], 'required', 'whenClient'=>'function(attribute, value){
            return $("#es-hijo").prop("checked");
          }']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nac' => 'Nacionalidad',
            'cedula' => 'Cédula',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'id_sexo' => 'Sexo',
            'fecha_nac' => 'Fecha Nacimiento',
            'id_padre' => 'Id Padre',
            'hijo' => 'N° Hijo',
            'activo' => 'Activo',
            'carnet' => 'Carnet de la Patria',
            'cod_carnet' => 'Código Carnet de la Patria',
            'clap' => 'CLAP',
            'nombre_clap' => 'Nombre CLAP',
            'enfermedad_cronica' => 'Enfermedad Cronica',
            'nombre_enfermedad' => 'Nombre Enfermedad',
            'own_cirugias' => 'Cirugías',
            'otras_cirugias' => 'Otras Cirugías',
            'codigo' => 'Código',
            'confirmado_carnet' => 'Confirmado Carnet Patria',
            'validar' => 'Validar Cirugia',
            'fecha_validado' => 'Fecha de Validacion',
            'operado' => 'Operado',
            'fecha_operado' => 'Fecha de la Operacion',
            'id_usuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNac()
    {
        return $this->hasOne(Nacionalidad::className(), ['id' => 'id_nac']);
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
    public function getEstatusCirugia()
    {
        return $this->hasOne(\common\models\EstatusCirugia::className(), ['id' => 'validar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSexo()
    {
        return $this->hasOne(Sexo::className(), ['id' => 'id_sexo']);
    }
    
    public function getRegistradores()
    {
      return $this->hasOne(Registrador::className(), ['id_datos_personales' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonalesHijos()
    {
        return $this->hasMany(DatosPersonalesHijo::className(), ['id_padre' => 'id']);
    }

    public function getSoliCirugias()
    {
           return $this->hasMany(SoliCirugia::className(), ['id_datos_personales' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichas()
    {
        return $this->hasMany(Ficha::className(), ['id_personal' => 'id']);
    }

    public function getDatosContactos() 
    { 
        return $this->hasOne(DatosContacto::className(), ['id_datos_personales' => 'id']); 
    } 

    public function getDatosContacto()
    {
        return $this->hasOne(DatosContacto::className(), ['id_datos_personales' => 'id']);
    }

    public function getPreoperatorio(){
      return $this->hasOne(Preoperatorio::className(), ['id_datos_personales' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarnetPatria()
    {
        return $this->hasOne(CarnetPatria::className(), ['id_datos_personales' => 'id']);
    }

    public function beforeSave($insert){
      parent::beforeSave($insert);

      /*if ($this->hijo != ""){
        $this->cedula = $this->cedula."-".$this->hijo;
      }*/

      return TRUE;
    }

    /*public function beforeValidate(){
      parent::beforeValidate();

      if ($this->hijo != ""){
        $this->cedula = $this->cedula."-".$this->hijo;
      }

      return TRUE;
    }*/

    /*public function afterValidate(){
      parent::beforeValidate();

      if ($this->hijo != ""){
        $partes = explode('-', $this->cedula);
        $this->cedula = $partes[0];
      }

      return TRUE;
    }*/

    public function afterFind(){
      parent::afterFind();

      if ($this->fecha_nac != NULL){
        $this->fecha_nac = date('d-m-Y', strtotime($this->fecha_nac));
      }

      if (!empty($this->soliCirugias)){
        foreach ($this->soliCirugias as $solicir) {
          $this->own_cirugias[] = $solicir->cirugia->id;
        }
      }

      if ($this->carnet !== NULL){
        $this->carnet = (int) $this->carnet;
      }

      if ($this->clap !== NULL){
        $this->clap = (int) $this->clap;
      }

      if ($this->enfermedad_cronica !== NULL){
        $this->enfermedad_cronica = (int) $this->enfermedad_cronica;
      }
      
        /*if($this->id_parroquia!=NULL)
        {
            $this->own_edo = $this->idParroquia->codigoMunicipio->codigo_estado;
            $this->own_muni = $this->idParroquia->codigo_municipio;      
        }      */

      /*if ($this->hijo != ""){
        $partes = explode('-', $this->cedula);
        $this->cedula = $partes[0];
      }*/

      return TRUE;
    }

    public function getLasCirugias(){
      $nombs = [];

      if (!empty($this->soliCirugias)){
        foreach ($this->soliCirugias as $cir){
          if ($cir->cirugia->id == 24)
            $nombs[] = $cir->datosPersonales->otras_cirugias;
          else
            $nombs[] = $cir->cirugia->nombre;
        }
      }

      return implode(', ', $nombs);
    }

    public function getIdUsuario(){
      return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }
}
