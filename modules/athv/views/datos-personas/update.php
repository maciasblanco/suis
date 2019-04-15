<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\DatosPersonas */

$this->title = 'Update Datos Personas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Datos Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="datos-personas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
