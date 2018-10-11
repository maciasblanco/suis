<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Certificado */

$this->title = 'Ficha de registro de Nacimiento';
$this->params['breadcrumbs'][] = ['label' => 'Certificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'padre' => $padre,
        'madre' => $madre,
    ]) ?>

</div>
