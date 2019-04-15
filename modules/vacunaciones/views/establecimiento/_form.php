<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\Establecimiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="establecimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'padre')->textInput() ?>

    <?= $form->field($model, 'htipo')->textInput() ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hlocalidad')->textInput() ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaoperacion')->textInput() ?>

    <?= $form->field($model, 'hnivel')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'x_utm')->textInput() ?>

    <?= $form->field($model, 'y_utm')->textInput() ?>

    <?= $form->field($model, 'altitud')->textInput() ?>

    <?= $form->field($model, 'hasic')->textInput() ?>

    <?= $form->field($model, 'funcionamiento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hdependencia_adm')->textInput() ?>

    <?= $form->field($model, 'nropersonas')->textInput() ?>

    <?= $form->field($model, 'hejes')->textInput() ?>

    <?= $form->field($model, 'cantidadfamilia')->textInput() ?>

    <?= $form->field($model, 'icono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ncamas')->textInput() ?>

    <?= $form->field($model, 'camhip')->textInput() ?>

    <?= $form->field($model, 'corposalud')->textInput() ?>

    <?= $form->field($model, 'horario')->textInput() ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuentadante')->textInput() ?>

    <?= $form->field($model, 'htipo2')->textInput() ?>

    <?= $form->field($model, 'nombrelargo_comu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombrelargo_trad')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
