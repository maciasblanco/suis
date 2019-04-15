<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\Municipio */

$this->title = 'Update Municipio: ' . $model->codigo_municipio;
$this->params['breadcrumbs'][] = ['label' => 'Municipios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_municipio, 'url' => ['view', 'id' => $model->codigo_municipio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="municipio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
