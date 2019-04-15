<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\MenorEdad */

$this->title = 'Create Menor Edad';
$this->params['breadcrumbs'][] = ['label' => 'Menor Edads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menor-edad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
