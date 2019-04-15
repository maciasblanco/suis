<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\ev25\models\DatosPersonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datos Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datos-personas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Datos Personas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            //'nacionalidad',
            //'parroquia_id',
            //'sexo',
            //'cedula',
            //'telefono',
            //'fechanac',
            //'carnet_patria:boolean',
            //'codigo_carnet',
            //'serial_carnet',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
