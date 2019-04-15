<?php



use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\sicasmi\models\Parroquia;
use app\modules\sicasmi\models\Municipio;
use app\modules\sicasmi\models\Estado;
use app\models\Nacionalidad;
use kartik\select2\Select2;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\DatosPersona */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content">

  <div class="row">
      <div class="col-lg-12 portlets">
        <div id="website-statistics1" class="widget">
            <div class="widget-header transparent">
                <h2><i class="icon-chart-line"></i>Datos Personales</h2>
           </div>
           <div class="widget-content">
               <div id="website-statistic" class="statistic-chart">
                  <div class="row">
                    <div class="col-md-3">
                      <?= $form->field($modelperso, 'nacionalidad')->dropDownList(ArrayHelper::map(Nacionalidad::find()->all(), 'id', 'letra'), [
                        'prompt' => 'Seleccione',
                        'onchange'=>'Consulta()',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelperso, 'cedula')->textInput([
                          'onchange'=>'Consulta()',
                        ]) ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($modelperso, 'primer_nombre')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelperso, 'segundo_nombre')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelperso, 'primer_apellido')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($modelperso, 'segundo_apellido')->textInput(['maxlength' => true]) ?>
                    </div>
                  </div>

                                  <div class="row"
                                      <div class="col-md-3">
                      <?= $form->field($modelperso, 'sexo')->hiddenInput(['value' => 1])->label(false) ?>
                                      </div>
                                    </div>
                                    <div>
                                 <div class="">
                                   <div class="col-md-3">
                        <?= $form->field($modelperso, 'fechanac')->textInput(['maxlength' => true]) ?>
                                   </div>
                                 </div>
                </div>
           </div>
         </div>
       </div>
     </div>
     </div>


     <div class="row">
         <div class="col-lg-12 portlets">
           <div id="website-statistics1" class="widget">
               <div class="widget-header transparent">
                   <h2><i class="icon-chart-line"></i>Datos de Ubicación y Contacto</h2>
              </div>
              <div class="widget-content">
                  <div id="website-statistic" class="statistic-chart">
                     <div class="row">
                       <div class="col-md-4">
                           <?=
                               $form->field($modelperso, 'estado')->widget(Select2::classname(), [
                               'data' => ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),
                               'language' => 'es',
                               'options' => [
                                 'placeholder' => 'Seleccionar Municipio',
                                 'onchange' => '
                                   $.get( "'.Url::toRoute('municipio/list').'", { id: $(this).val()})
                                     .done(function( data ){
                                       $( "select#datospersonas-municipio" ).html( data );
                                           }
                                         );'
                                       ],
                               'pluginOptions' => [
                                   'allowClear' => true
                               ],
                               ]);
                           ?>
                       </div>
                       <div class="col-md-4">
                           <?=
                               $form->field($modelperso, 'municipio')->widget(Select2::classname(), [
                               'data' => ArrayHelper::map(Municipio::find()->all(),'codigo_municipio','municipio'),
                               'language' => 'es',
                               'options' => [
                                 'placeholder' => 'Seleccionar Municipio',
                                 'onchange' => '
                                   $.get( "'.Url::toRoute('parroquia/list').'", { id: $(this).val()})
                                     .done(function( data ){
                                       $( "select#datospersonas-parroquia_id" ).html( data );
                                           }
                                         );'
                                       ],
                               'pluginOptions' => [
                                   'allowClear' => true
                               ],
                               ]);
                           ?>
                       </div>
                         <div class="col-md-4">
                             <?=
                                 $form->field($modelperso, 'parroquia_id')->widget(Select2::classname(), [
                                 'data' => ArrayHelper::map(Parroquia::find()->all(),'id_parroquia','parroquia'),
                                 'language' => 'de',
                                 'options' => ['placeholder' => 'Seleccionar Parrroquia'],
                                 'pluginOptions' => [
                                     'allowClear' => true
                                 ],
                                 ]);
                             ?>
                         </div>
                     <div class="col-md-6" id="ct">

                         <?= $form->field($modelperso, 'telefono')->textInput() ?>
                     </div>
                     </div>
                     <div class="row">
                       <div class="col-md-4" id="ct">
                           <?= $form->field($modelperso, 'carnet_patria')->checkbox() ?>
                       </div>
                       <div class="col-md-4" id="ct">
                           <?= $form->field($modelperso, 'codigo_carnet')->textInput(['disabled' => true]) ?>
                       </div>
                       <div class="col-md-4" id="ct">
                           <?= $form->field($modelperso, 'serial_carnet')->textInput(['disabled' => true]) ?>
                       </div>
                     </div>
              </div>
            </div>
          </div>
        </div>
        </div>

