<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\Parroquia */

$this->title = 'Update Parroquia: ' . $model->codigo_parroquia;
$this->params['breadcrumbs'][] = ['label' => 'Parroquias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_parroquia, 'url' => ['view', 'id' => $model->codigo_parroquia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parroquia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
