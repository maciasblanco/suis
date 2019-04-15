<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\ParroquiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parroquia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codigo_parroquia') ?>

    <?= $form->field($model, 'parroquia') ?>

    <?= $form->field($model, 'codigo_municipio') ?>

    <?= $form->field($model, 'id_parrofarma') ?>

    <?= $form->field($model, 'id_parroquia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
