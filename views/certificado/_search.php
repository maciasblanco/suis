<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CertificadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_establecimiento') ?>

    <?= $form->field($model, 'num_historia') ?>

    <?= $form->field($model, 'id_centro') ?>

    <?= $form->field($model, 'codigo_estado') ?>

    <?php // echo $form->field($model, 'codigo_municipio') ?>

    <?php // echo $form->field($model, 'codigo_paroquia') ?>

    <?php // echo $form->field($model, 'codigo_comunidad') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'id_madre') ?>

    <?php // echo $form->field($model, 'id_padre') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora') ?>

    <?php // echo $form->field($model, 'semana_gestacion') ?>

    <?php // echo $form->field($model, 'talla') ?>

    <?php // echo $form->field($model, 'peso') ?>

    <?php // echo $form->field($model, 'resp_cedula') ?>

    <?php // echo $form->field($model, 'resp_reg') ?>

    <?php // echo $form->field($model, 'resp_nomb') ?>

    <?php // echo $form->field($model, 'id_sexo') ?>

    <?php // echo $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'apellido') ?>

    <?php // echo $form->field($model, 'codigo') ?>

    <?php // echo $form->field($model, 'id_malformacion_cong') ?>

    <?php // echo $form->field($model, 'perimetro_cefalico') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
