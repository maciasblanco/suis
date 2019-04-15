<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\vacunaciones\models\MenorEdad;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\MenorEdad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menor-edad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelmenor, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelmenor, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelmenor, 'id_representante')->textInput() ?>

    <?= $form->field($modelmenor, 'n_hijo')->textInput() ?>

    <?= $form->field($modelmenor, 'fecha_nac')->textInput() ?>

    <?= $form->field($modelmenor, 'id_sexo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
