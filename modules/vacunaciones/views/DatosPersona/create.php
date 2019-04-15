<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\DatosPersona */

$this->title = 'Create Datos Persona';
$this->params['breadcrumbs'][] = ['label' => 'Datos Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datos-persona-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
