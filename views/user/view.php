<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\models\User;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <center><h1><?= Html::encode($this->title) ?></h1></center>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            [
              'attribute'=>'status',
              'value'=>$model->status == User::STATUS_ACTIVE ? 'Activo' : 'Inactivo',
            ],
        ],
    ]) ?>

    <p style="text-align:center">
      <?= Html::a('Volver', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
