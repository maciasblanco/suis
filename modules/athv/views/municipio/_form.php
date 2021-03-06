<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\Municipio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="municipio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_municipio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_munifarma')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
