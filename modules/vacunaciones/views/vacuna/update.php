<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\Vacuna */

$this->title = 'Update Vacuna: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vacunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacuna-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
