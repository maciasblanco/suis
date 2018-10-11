<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
             [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->status == User::STATUS_ACTIVE ? 'Activo' : 'Inactivo';
                }
             ],

            [
              'class' => 'yii\grid\ActionColumn',
              'visibleButtons'=>[
                'delete'=>function($model){
                  return $model->status == User::STATUS_ACTIVE;
                },
                'update'=>function($model){
                  return $model->status == User::STATUS_ACTIVE;
                }
                ],
            ],
        ],
    ]); ?>
</div>
