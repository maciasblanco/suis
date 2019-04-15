<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\modules\athv\models\DatosPersonas;
use app\modules\athv\models\Parroquia;
use app\modules\athv\models\Estado;
use app\modules\athv\models\Municipio;
use app\modules\athv\models\LugarHecho;
use app\modules\athv\models\SitioMuerte;
use app\modules\athv\models\TipoHecho;
use app\modules\athv\models\DiagnosticoAsociado;
use app\modules\athv\models\DiagnosticoUbicacion;
use app\modules\athv\models\ObjetoHecho;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\HechoViolento */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="hecho-violento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $this->renderAjax('@app/modules/athv/views/datos-personas/_form',[
        'modelperso' => $modelperso,
        'form' => $form,
        ])
    ?>

    <div class="col-lg-12 portlets">
        <div id="website-statistics1" class="widget">
            <div class="widget-header transparent">
                <h2><i class="icon-chart-line"></i>  Datos De Ocurrencia</h2>
            </div>
            <div class="widget-content">
                <div id="website-statistic" class="statistic-chart">
                    <div class="row">
                        <div class="col-md-4">
                              <?= $form->field($model, 'estado')->dropDownList(ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),
                                [
                                    'prompt' => 'Seleccionar Estado',
                                    'onchange' => '
                                        $.get( "'.Url::toRoute('municipio/list').'", { id: $(this).val()})
                                            .done(function( data ){
                                            $( "select#hechoviolento-municipio" ).html( data );
                                                }
                                                );'
                                ]
                               ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'municipio')->dropDownList(ArrayHelper::map(Municipio::find()->all(),'codigo_municipio','municipio'),
                            [
                                'prompt' => 'Seleccionar Municipio',
                                'onchange' => '
                                $.get( "'.Url::toRoute('parroquia/list').'", { id: $(this).val()})
                                    .done(function( data ){
                                    $( "select#hechoviolento-id_parroquia" ).html( data );
                                        }
                                        );'
                            ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                             <?= $form->field($model, 'id_parroquia')->dropDownList(ArrayHelper::map(Parroquia::find()->all(),'id_parroquia','parroquia'),
                                ['prompt' => 'Seleccionar Parroquia']
                             ) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12 portlets">
        <div id="website-statistics1" class="widget">
            <div class="widget-header transparent">
                <h2><i class="icon-chart-line"></i>  Datos Del Hecho Violento</h2>
            </div>
            <div class="widget-content">
                <div id="website-statistic" class="statistic-chart">
                    <div class="row">
                        <div class="col-md-2">
                              <?= $form->field($model, 'id_lugar_hecho')->dropDownList(ArrayHelper::map(LugarHecho::find()->all(),'id','descripcion'),
                                ['prompt' => 'Seleccionar Lugar del Hecho']
                              ) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'id_sitio_muerte')->dropDownList(ArrayHelper::map(SitioMuerte::find()->all(),'id','descripcion'),
                                ['prompt' => 'Seleccionar Sitio de La Muerte']
                            ) ?>
                        </div>
                        <div class="col-md-8">
                             <?= $form->field($model, 'observacion')->textInput(['rows' => 6]) ?> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                              <?= $form->field($model, 'id_tipo_hecho')->dropDownList(ArrayHelper::map(TipoHecho::find()->all(),'id','descripcion'),
        ['prompt' => 'Seleccionar tipo de hecho']
    ) ?>
                        </div>
                        <div class="col-md-3">
                              <?= $form->field($model, 'id_diagnostico_asociado')->dropDownList(ArrayHelper::map(DiagnosticoAsociado::find()->all(),'id','descripcion'),
        ['prompt' => 'Seleccionar diagnostico asociado']
    ) ?>
                        </div>
                        <div class="col-md-3">
                              <?= $form->field($model, 'id_diagnostico_ubicacion')->dropDownList(ArrayHelper::map(DiagnosticoUbicacion::find()->all(),'id','descripcion'),
        ['prompt' => 'Seleccionar ubicacion del diagnostico']
    ) ?>
                        </div>
                        <div class="col-md-3">
                             <?= $form->field($model, 'id_objeto_hecho')->dropDownList(ArrayHelper::map(ObjetoHecho::find()->all(),'id','descripcion'),
        ['prompt' => 'Seleccionar Objeto del Hecho']
    ) ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    

   

   

   

    

   

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
