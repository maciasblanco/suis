<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\Estado */

$this->title = 'Update Estado: ' . $model->codigo_estado;
$this->params['breadcrumbs'][] = ['label' => 'Estados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_estado, 'url' => ['view', 'id' => $model->codigo_estado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
