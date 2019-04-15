<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\AccidenteTransitoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accidente-transito-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_parroquia') ?>

    <?= $form->field($model, 'direccion') ?>

    <?= $form->field($model, 'id_sitio_muerte') ?>

    <?= $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'id_tipo_accidente') ?>

    <?php // echo $form->field($model, 'id_tipo_vehiculo') ?>

    <?php // echo $form->field($model, 'id_tipo_afectado') ?>

    <?php // echo $form->field($model, 'id_diagnostico_asociado') ?>

    <?php // echo $form->field($model, 'id_diagnostico_ubicacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
