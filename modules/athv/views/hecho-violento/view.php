<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\modules\athv\models\Parroquia;
use app\modules\athv\models\LugarHecho;
use app\modules\athv\models\SitioMuerte;
use app\modules\athv\models\TipoHecho;
use app\modules\athv\models\DiagnosticoAsociado;
use app\modules\athv\models\DiagnosticoUbicacion;
use app\modules\athv\models\ObjetoHecho;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\HechoViolento */

$this->title = 'Hecho Violento N° ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hecho Violentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-12 portlets">
            <div class="widget">
                <div class="widget-content padding"> 

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->id], [
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
            //'id',
            [
                'attribute'=>'id_parroquia',
                'value'=>function($model){
                    if ($model->parroquia != null) {
                        return $model->parroquia->parroquia;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(Parroquia::find()->all(),'id_parroquia','parroquia')
            ],
            'direccion:ntext',
            [
                'attribute'=>'id_tipo_hecho',
                'value'=>function($model){
                    if ($model->tipoHecho != null) {
                        return $model->tipoHecho->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(TipoHecho::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_objeto_hecho',
                'value'=>function($model){
                    if ($model->objetoHecho != null) {
                        return $model->objetoHecho->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(ObjetoHecho::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_lugar_hecho',
                'value'=>function($model){
                    if ($model->lugarHecho != null) {
                        return $model->lugarHecho->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(LugarHecho::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_sitio_muerte',
                'value'=>function($model){
                    if ($model->sitioMuerte != null) {
                        return $model->sitioMuerte->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(SitioMuerte::find()->all(),'id','descripcion')
            ],
            'observacion:ntext',
            [
                'attribute'=>'id_diagnostico_asociado',
                'value'=>function($model){
                    if ($model->diagnosticoAsociado != null) {
                        return $model->diagnosticoAsociado->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(DiagnosticoAsociado::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_diagnostico_ubicacion',
                'value'=>function($model){
                    if ($model->diagnosticoUbicacion != null) {
                        return $model->diagnosticoUbicacion->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(DiagnosticoUbicacion::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_dato_persona',
                'value'=>function($model){
                    if ($model->datosPersonas != null) {
                        return $model->datosPersonas->primer_nombre . ' ' . $model->datosPersonas->primer_apellido . ' CI: V-' . $model->datosPersonas->cedula;
                    } else {
                        return '';
                    }
                },
                //'filter' => ArrayHelper::map(DatosPersonas::find()->all(),'id','primer_nombre', 'primer_apellido', 'cedula')
            ],
        ],
    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
