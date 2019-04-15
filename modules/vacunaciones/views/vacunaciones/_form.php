<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\vacunaciones\models\Vacuna;
use app\modules\vacunaciones\models\Dosis; 
use app\modules\vacunaciones\models\Establecimiento;
use app\modules\vacunaciones\models\TipoMision;
use app\modules\vacunaciones\models\TipoVacunacion;
use app\modules\vacunaciones\models\CondicionEspecial;


/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\Vacunaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacunaciones-form">



    <?php $form = ActiveForm::begin(); ?>
    

   

    <?= $form->field($model, 'id_dato_persona')->textInput() ?>

    <div class="content">
    <?= $this->renderAjax('@app/modules/vacunaciones/views/DatosPersona/_form',[
      'modelperso' => $modelperso,
      'form' => $form,
      ])
      ?>
    </div>
    

    <?= $form->field($model, 'fecha')->hiddenInput(['value' => date('y-m-d h:m:s')])->label(false)  ?>

    <?= $form->field($model, 'id_vacuna')->dropDownList(ArrayHelper::map(Vacuna::find()->all(),'id', 'descripcion'),['prompt' => 'Seleccione una vacuna']) ?>

    <?= $form->field($model, 'id_dosis')->dropDownList(ArrayHelper::map(Dosis::find()->all(),'id', 'descripcion'),['prompt' => 'Seleccione dosis']) ?>

    <?= $form->field($model, 'id_establecimiento')->textInput([
                  'onchange'=>'
                  var cod = $(this).val();

                  if (cod == "")
                    return false;

                  $.get("'.(Yii::$app->urlManager->createUrl(["/vacunaciones/precarga-establecimiento"])).'",
                    {"cod": cod},
                    function(data) {
                      if (data != "") {
                        var datos = JSON.parse(data);
                        $("#certificado-id_establecimiento").val(datos.e).prop("readonly", true);
                        $("#certificado-own_nomb_est").val(datos.nombre).prop("readonly", true);

                        if (datos.n3 == null) {
                          $("#certificado-codigo_estado").val(datos.n1).prop("readonly", true);
                          $("#certificado-own_nomb_edo").val(datos.n1txt).prop("readonly", true);
                          $("#certificado-codigo_municipio").val("").prop("readonly", true);
                          $("#certificado-own_nomb_muni").val("").prop("readonly", true);
                          $("#certificado-codigo_paroquia").val("").prop("readonly", true);
                          $("#certificado-own_nomb_parro").val("").prop("readonly", true);
                        } else if (datos.n3 == \'00\') {
                          $("#certificado-codigo_estado").val(datos.n2).prop("readonly", true);
                          $("#certificado-own_nomb_edo").val(datos.n2txt).prop("readonly", true);
                          $("#certificado-codigo_municipio").val(datos.n1).prop("readonly", true);
                          $("#certificado-own_nomb_muni").val(datos.n1txt).prop("readonly", true);
                          $("#certificado-codigo_paroquia").val("").prop("readonly", true);
                          $("#certificado-own_nomb_parro").val("").prop("readonly", true);
                        } else {
                          $("#certificado-codigo_estado").val(datos.n3).prop("readonly", true);
                          $("#certificado-own_nomb_edo").val(datos.n3txt).prop("readonly", true);
                          $("#certificado-codigo_municipio").val(datos.n2).prop("readonly", true);
                          $("#certificado-own_nomb_muni").val(datos.n2txt).prop("readonly", true);
                          $("#certificado-codigo_paroquia").val(datos.n1).prop("readonly", true);
                          $("#certificado-own_nomb_parro").val(datos.n1txt).prop("readonly", true);
                        }
                      } else {

                    }
                  });
                ']) ?>

    <?= $form->field($model, 'id_tipo_mision')->dropDownList(ArrayHelper::map(TipoMision::find()->all(),'id', 'descripcion'),['prompt' => 'Seleccione mision']) ?>

    <?= $form->field($model, 'n_hijo')->textInput() ?>

    <?= $form->field($model, 'lote_amarilica')->textInput() ?>

    <?= $form->field($model, 'id_tipo_vacunacion')->dropDownList(ArrayHelper::map(TipoVacunacion::find()->all(),'id', 'descripcion'),['prompt' => 'Seleccione']) ?>

    <?= $form->field($model, 'id_condicion_especial')->dropDownList(ArrayHelper::map(CondicionEspecial::find()->all(),'id', 'descripcion'),['prompt' => 'Seleccione Condicion']) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
 