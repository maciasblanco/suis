<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Nacionalidad;
use app\modules\athv\models\Parroquia;
use app\modules\athv\models\Estado;
use app\modules\athv\models\Municipio;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\DatosPersonas */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui/jquery-ui.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/jquery-ui/jquery-ui.min.css');
$this->registerJsFile(Yii::getAlias('@web').'/js/chosen/chosen.jquery.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/chosen/chosen.min.css');
$this->registerJs(' Consulta=function() {
    var ci = $("#datospersonas-cedula").val();
    var nac = $("#datospersonas-nacionalidad").val();

    
        $.get("'.(Yii::$app->urlManager->createUrl(["/athv/datos-personas/consulta"])).'",
            {"nac":nac, "ci":ci},
            function(data) {

            if (data != "") {

                var datos = JSON.parse(data);
                console.log(datos);
                console.log(typeof datos[0].PRIMERAPELLIDO);

                if (typeof datos[0].PRIMERAPELLIDO == "undefined") {
                    if (nac != "" && ci != ""){
                        $("#w0").yiiActiveForm("updateAttribute", "datospersonas-cedula", ["Esta cedula no corresponde a ninguna persona"]);
                    }
                }
                else{
                    $("#datospersonas-primer_apellido").val(datos[0].PRIMERAPELLIDO);
                    $("#datospersonas-segundo_apellido").val(datos[0].SEGUNDOAPELLIDO);
                    $("#datospersonas-primer_nombre").val(datos[0].PRIMERNOMBRE);
                    $("#datospersonas-segundo_nombre").val(datos[0].SEGUNDONOMBRE);
                    $("#datospersonas-fechanac").val(datos[0].FECHANAC);
                    $("#datospersonas-sexo").val(datos[0].SEXO);
                    $("#datospersonas-telefono").val(datos[0].TELEFONO);
                    $("#w0").yiiActiveForm("updateAttribute", "datospersonas-cedula", "");
                }
            }
            })
        }');


?>

<div class="datos-personas-form">

    <div class="col-lg-12 portlets">
        <div id="website-statistics1" class="widget">
            <div class="widget-header transparent">
                <h2><i class="icon-chart-line"></i>Datos Personales</h2>
            </div>
            <div class="widget-content">
                <div id="website-statistic" class="statistic-chart">
                    <div class="row">
                        <div class="col-md-2" style="margin-left: 5px;">
                              <?= $form->field($modelperso, 'cedula')->textInput([
                            'onchange'=>'Consulta()',
                            ]) ?>
                        </div>
                        <div class="col-md-2">
                           <?= $form->field($modelperso, 'nacionalidad')->dropDownList(ArrayHelper::map(Nacionalidad::find()->all(), 'id', 'letra'), [
                                'prompt' => 'Seleccione',
                                'onchange'=>'Consulta()',
                           ]) ?>  
                        </div>
                        <div class="col-md-2">
                             <?= $form->field($modelperso, 'sexo')->textInput(['maxlength' => true, 'readonly'=> 'readonly']) ?>
                        </div>

                        <div class="col-md-3">
                              <?= $form->field($modelperso, 'primer_apellido')->textInput(['maxlength' => true, 'readonly'=> 'readonly']) ?>
                        </div>

                        <div class="col-md-2">
                              <?= $form->field($modelperso, 'segundo_apellido')->textInput(['maxlength' => true, 'readonly'=> 'readonly']) ?>
                    </div>
                </div>

                   <div class="row">
                       <div class="col-md-2" style="margin-left: 5px;">
                           <?= $form->field($modelperso, 'primer_nombre')->textInput(['maxlength' => true, 'readonly'=> 'readonly']) ?>
                       </div>
                       <div class="col-md-3">
                           <?= $form->field($modelperso, 'segundo_nombre')->textInput(['maxlength' => true, 'readonly'=> 'readonly']) ?>
                       </div>
                       <div class="col-md-3">
                           <?= $form->field($modelperso, 'fechanac')->textInput(['readonly'=> 'readonly']) ?>
                       </div>
                       <div class="col-md-3">
                           <?= $form->field($modelperso, 'telefono')->textInput() ?>
                       </div>
                    </div>

                    <div class="row">
                       <div class="col-md-3" style="margin-left: 5px;">
                            <?= $form->field($modelperso, 'estado')->dropDownList(ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),
                                [
                                    'prompt' => 'Seleccionar Estado de Nacimiento',
                                    'onchange' => '
                                        $.get( "'.Url::toRoute('municipio/list').'", { id: $(this).val()})
                                            .done(function( data ){
                                            $( "select#datospersonas-municipio" ).html( data );
                                                }
                                                );'
                                ]
                            ) ?>
                       </div>
                       <div class="col-md-4">
                           <?= $form->field($modelperso, 'municipio')->dropDownList(ArrayHelper::map(Municipio::find()->all(),'codigo_municipio','municipio'),
                                [
                                    'prompt' => 'Seleccionar Municipio de Nacimiento',
                                    'onchange' => '
                                    $.get( "'.Url::toRoute('parroquia/list').'", { id: $(this).val()})
                                        .done(function( data ){
                                        $( "select#datospersonas-parroquia_id" ).html( data );
                                            }
                                            );'
                                ]
                            ) ?>
                       </div>
                       <div class="col-md-4">
                            <?= $form->field($modelperso, 'parroquia_id')->dropDownList(ArrayHelper::map(Parroquia::find()->all(),'id_parroquia','parroquia'),
                                ['prompt' => 'Seleccionar Parroquia de Nacimiento']
                            ) ?>
                       </div>
                    </div>

            </div>
        </div>
    </div>

    <?php /* $form = ActiveForm::begin(); */ ?>

    <?php // $form->field($modelperso, 'id')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($modelperso, 'carnet_patria')->checkbox() ?>

    <?php // $form->field($modelperso, 'codigo_carnet')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($modelperso, 'serial_carnet')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php /* Html::submitButton('Save', ['class' => 'btn btn-success']) */ ?>
    </div>

</div>
