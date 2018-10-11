<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Certificado */

$this->title ='Certificado N° '.$model->codigo_unico;
$this->params['breadcrumbs'][] = ['label' => 'Certificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php /*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'idEstablecimiento.nombre',
            'num_historia',
            'idCentro.nombre',
            'codigoEstado.estado',
            'codigoMunicipio.municipio',
            'codigoParroquia.parroquia',
            'comunidad',
            //'direccion',
            //'id_madre',
            //'id_padre',
            'fecha',
            'hora',
            'semana_gestacion',
            'talla',
            'peso',
            'resp_cedula',
            'resp_reg',
            'resp_nomb',
            [
            'attribute'=> 'id_sexo',
            'value'=> $model->idSexo->descripcion
            ],
            'nombre_1',
            'nombre_2',
            'apellido_1',
            'apellido_2',
            //'codigo',
            //'id_malformacion_cong',
            'perimetro_cefalico',
        ],
    ]) ?>

</div>
