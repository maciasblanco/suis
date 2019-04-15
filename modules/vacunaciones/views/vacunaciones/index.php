<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\vacunaciones\models\VacunacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacunaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vacunaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_dato_persona',
            'fecha',
            'id_vacuna',
            'id_dosis',
            //'id_establecimiento',
            //'id_tipo_mision',
            //'n_hijo',
            //'lote_amarilica',
            //'id_tipo_vacunacion',
            //'id_condicion_especial',
            //'id_menor_edad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
