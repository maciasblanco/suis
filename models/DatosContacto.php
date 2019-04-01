<?php

namespace frontend\models;

use Yii;
use common\models\Asic;
use common\models\Municipio;
use common\models\Parroquia;
use common\models\Parentesco;

/**
 * This is the model class for table "cirugia.datos_contacto".
 *
 * @property integer $id
 * @property integer $id_datos_personales
 * @property string $tlf_contacto
 * @property string $tlf_contacto_2
 * @property string $tlf_celular
 * @property string $tlf_celular_2
 * @property string $twitter
 * @property string $instagram
 * @property string $facebook
 * @property string $nombre_pariente
 * @property string $tlf_pariente
 * @property string $email
 * @property string $cod_parroquia
 * @property integer $id_asic
 * @property string $direccion
 *
 * @property Asic $idAsic
 * @property Parroquia $codParroquia
 * @property DatosPersonales $idDatosPersonales
 */
class DatosContacto extends \yii\db\ActiveRecord
{
    public $own_edo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cirugia.datos_contacto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_datos_personales', 'own_muni', 'cod_parroquia'], 'required'],
            [['id_datos_personales', 'id_asic', 'id_parentesco'], 'integer'],
            [['nombre_pariente', 'tlf_pariente', 'own_muni', 'cod_parroquia', 'direccion', 'twitter', 'instagram', 'facebook', 'email'], 'default', 'value'=>NULL],
            [['own_muni', 'cod_parroquia', 'direccion'], 'string'],
            [['tlf_celular', 'tlf_celular_2'], 'match', 'pattern'=>'/^04(([12][46])|(1[2]))\d{7}$/', 'message'=>'El número de teléfono debe empezar con un código válido (0416, 0426, 0414, 0424, 0412) y tener 11 caracteres.'],
            [['tlf_contacto', 'tlf_contacto_2', 'tlf_pariente'], 'match', 'pattern'=>'/^0\d{10}$/', 'message'=>'El número de teléfono debe tener 11 caracteres numéricos, incluyendo el 0 inicial.'],
            [['nombre_pariente'], 'string', 'max' => 255],
            [['twitter', 'instagram', 'facebook', 'email'], 'string', 'max' => 100],
            [['id_asic'], 'exist', 'skipOnError' => true, 'targetClass' => Asic::className(), 'targetAttribute' => ['id_asic' => 'id']],
            [['cod_parroquia'], 'exist', 'skipOnError' => true, 'targetClass' => Parroquia::className(), 'targetAttribute' => ['cod_parroquia' => 'codigo_parroquia']],
            [['id_datos_personales'], 'exist', 'skipOnError' => true, 'targetClass' => DatosPersonales::className(), 'targetAttribute' => ['id_datos_personales' => 'id']],
            [['id_parentesco'], 'exist', 'skipOnError' => true, 'targetClass' => Parentesco::className(), 'targetAttribute' => ['id_parentesco' => 'id']], 
            [['own_edo'], 'safe'],
            [['id_parentesco'], 'required', 'when'=>function($model){
              return $model->nombre_pariente != NULL;
            }, 'whenClient'=>'function(attribute, value){
              return $("#datoscontacto-nombre_pariente").val() != "";
            }'],
            [['tlf_celular'], 'required', 'when'=>function($model){
                return $model->tlf_contacto == NULL;
              }, 'whenClient'=>'function(attribute, value){
                return $("#datoscontacto-tlf_contacto").val() == "";
              }'],
            [['tlf_contacto'], 'required', 'when'=>function($model){
                return $model->tlf_celular == NULL;
              }, 'whenClient'=>'function(attribute, value){
                return $("#datoscontacto-tlf_celular").val() == "";
              }'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_datos_personales' => 'Datos Personales',
            'tlf_contacto' => 'Tlf Local',
            'tlf_contacto_2' => 'Tlf Local 2',
            'tlf_celular' => 'Tlf Celular',
            'tlf_celular_2' => 'Tlf Celular 2',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'nombre_pariente' => 'Nombre Pariente',
            'tlf_pariente' => 'Tlf Pariente',
            'email' => 'Email',
            'cod_parroquia' => 'Parroquia',
            'id_asic' => 'Asic',
            'direccion' => 'Dirección',
            'id_parentesco' => 'Parentesco', 
            'own_edo' => 'Estado',
            'own_muni' => 'Municipio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAsic()
    {
        return $this->hasOne(Asic::className(), ['id' => 'id_asic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['codigo_parroquia' => 'cod_parroquia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosPersonales()
    {
        return $this->hasOne(DatosPersonales::className(), ['id' => 'id_datos_personales']);
    }

    public function getParentesco() 
    { 
      return $this->hasOne(Parentesco::className(), ['id' => 'id_parentesco']); 
    } 

    public function getMunicipio() 
    { 
      return $this->hasOne(Municipio::className(), ['codigo_municipio' => 'own_muni']); 
    } 


    public function afterFind(){
      parent::afterFind();

      if ($this->codParroquia!=NULL){
          $this->own_edo = $this->codParroquia->codigoMunicipio->codigoEstado;
          //$this->own_muni = $this->codParroquia->codigoMunicipio;      
      }
      else if ($this->id_asic != NULL){
        $this->own_edo = $this->idAsic->codigoEstado->codigo_estado;
      }

      if ($this->own_muni == NULL && $this->cod_parroquia != NULL){
        $this->own_muni = $this->codParroquia->codigo_municipio;
      }

      /*if ($this->hijo != ""){
        $partes = explode('-', $this->cedula);
        $this->cedula = $partes[0];
      }*/

      return TRUE;
    }

    public function beforeSave($insert){
      parent::beforeSave($insert);

      if ($this->cod_parroquia == ""){
        $this->cod_parroquia = NULL;
      }

      return TRUE;
    }
}
