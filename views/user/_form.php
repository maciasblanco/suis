<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::getAlias('@web').'/js/chosen/chosen.jquery.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/chosen/chosen.min.css');
$this->registerJs('
    //Para activar el chosen
    $("select").chosen({
        allow_single_deselect: true,
        no_results_text: "No se han encontrado resultados",
        placeholder_text_multiple: "Selecciona una o más opciones",
        placeholder_text_single: "Seleccione una opcion"
    });
    ');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord): ?>
      <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_clave')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_rol')
      ->dropDownList(ArrayHelper::map($roles, 'name', 'name'), [
        'prompt'=>'- Seleccione -'
        ]) ?>
        
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
