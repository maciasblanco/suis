<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\VacunacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacunaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_dato_persona') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'id_vacuna') ?>

    <?= $form->field($model, 'id_dosis') ?>

    <?php // echo $form->field($model, 'id_establecimiento') ?>

    <?php // echo $form->field($model, 'id_tipo_mision') ?>

    <?php // echo $form->field($model, 'n_hijo') ?>

    <?php // echo $form->field($model, 'lote_amarilica') ?>

    <?php // echo $form->field($model, 'id_tipo_vacunacion') ?>

    <?php // echo $form->field($model, 'id_condicion_especial') ?>

    <?php // echo $form->field($model, 'id_menor_edad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
