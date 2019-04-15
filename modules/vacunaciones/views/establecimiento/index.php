<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\vacunaciones\models\EstablecimientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Establecimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="establecimiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Establecimiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo',
            'nombre',
            'padre',
            'htipo',
            //'direccion',
            //'hlocalidad',
            //'telefono',
            //'status',
            //'fechaoperacion',
            //'hnivel',
            //'descripcion:ntext',
            //'x_utm',
            //'y_utm',
            //'altitud',
            //'hasic',
            //'funcionamiento',
            //'hdependencia_adm',
            //'nropersonas',
            //'hejes',
            //'cantidadfamilia',
            //'icono',
            //'ncamas',
            //'camhip',
            //'corposalud',
            //'horario',
            //'usuario',
            //'rif',
            //'cuentadante',
            //'htipo2',
            //'nombrelargo_comu',
            //'nombrelargo_trad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
