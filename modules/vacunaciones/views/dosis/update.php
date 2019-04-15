<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\Dosis */

$this->title = 'Update Dosis: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dosis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
