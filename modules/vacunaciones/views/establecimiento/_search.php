<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\EstablecimientoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="establecimiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'padre') ?>

    <?= $form->field($model, 'htipo') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'hlocalidad') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'fechaoperacion') ?>

    <?php // echo $form->field($model, 'hnivel') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'x_utm') ?>

    <?php // echo $form->field($model, 'y_utm') ?>

    <?php // echo $form->field($model, 'altitud') ?>

    <?php // echo $form->field($model, 'hasic') ?>

    <?php // echo $form->field($model, 'funcionamiento') ?>

    <?php // echo $form->field($model, 'hdependencia_adm') ?>

    <?php // echo $form->field($model, 'nropersonas') ?>

    <?php // echo $form->field($model, 'hejes') ?>

    <?php // echo $form->field($model, 'cantidadfamilia') ?>

    <?php // echo $form->field($model, 'icono') ?>

    <?php // echo $form->field($model, 'ncamas') ?>

    <?php // echo $form->field($model, 'camhip') ?>

    <?php // echo $form->field($model, 'corposalud') ?>

    <?php // echo $form->field($model, 'horario') ?>

    <?php // echo $form->field($model, 'usuario') ?>

    <?php // echo $form->field($model, 'rif') ?>

    <?php // echo $form->field($model, 'cuentadante') ?>

    <?php // echo $form->field($model, 'htipo2') ?>

    <?php // echo $form->field($model, 'nombrelargo_comu') ?>

    <?php // echo $form->field($model, 'nombrelargo_trad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
