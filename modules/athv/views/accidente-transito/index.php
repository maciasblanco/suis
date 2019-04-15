<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\modules\athv\models\SitioMuerte;
use app\modules\athv\models\DiagnosticoAsociado;
use app\modules\athv\models\DiagnosticoUbicacion;
use app\modules\athv\models\TipoVehiculo;
use app\modules\athv\models\TipoAfectado;
use app\modules\athv\models\TipoAccidente;
use app\modules\athv\models\DatosPersonas;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\athv\models\AccidenteTransitoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accidente Transitos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

    <div class="row">
        <div class="col-sm-12 portlets">
            <div class="widget">
                <div class="widget-content padding">

                      <p>
                        <?= Html::a('Registrar Accidente Transito', ['create'], ['class' => 'btn btn-success']) ?>
                      </p>

                    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_parroquia',
            //'direccion:ntext',
            [
                'attribute'=>'id_tipo_accidente',
                'value'=>function($model){
                    if ($model->tipoAccidente != null) {
                        return $model->tipoAccidente->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(TipoAccidente::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_tipo_vehiculo',
                'value'=>function($model){
                    if ($model->tipoVehiculo != null) {
                        return $model->tipoVehiculo->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(TipoVehiculo::find()->all(),'id','descripcion')
            ],
            [
                'attribute'=>'id_tipo_afectado',
                'value'=>function($model){
                    if ($model->tipoAfectado != null) {
                        return $model->tipoAfectado->descripcion;
                    } else {
                        return null;
                    }
                },
                'filter' => ArrayHelper::map(TipoAfectado::find()->all(),'id','descripcion')
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
            //'observacion:ntext',
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

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view},{update}'],
        ],
    ]); ?>
                </div>
            </div>
        </div>
    </div>
   
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php Pjax::end(); ?>
</div>
