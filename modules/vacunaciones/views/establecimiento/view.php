<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\vacunaciones\models\Establecimiento */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Establecimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="establecimiento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo',
            'nombre',
            'padre',
            'htipo',
            'direccion',
            'hlocalidad',
            'telefono',
            'status',
            'fechaoperacion',
            'hnivel',
            'descripcion:ntext',
            'x_utm',
            'y_utm',
            'altitud',
            'hasic',
            'funcionamiento',
            'hdependencia_adm',
            'nropersonas',
            'hejes',
            'cantidadfamilia',
            'icono',
            'ncamas',
            'camhip',
            'corposalud',
            'horario',
            'usuario',
            'rif',
            'cuentadante',
            'htipo2',
            'nombrelargo_comu',
            'nombrelargo_trad',
        ],
    ]) ?>

</div>
