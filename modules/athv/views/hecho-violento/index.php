<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\modules\athv\models\Parroquia;
use app\modules\athv\models\LugarHecho;
use app\modules\athv\models\SitioMuerte;
use app\modules\athv\models\TipoHecho;
use app\modules\athv\models\DiagnosticoAsociado;
use app\modules\athv\models\DiagnosticoUbicacion;
use app\modules\athv\models\ObjetoHecho;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\athv\models\HechoViolentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hecho Violentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

        <div class="row">
            <div class="col-sm-12 portlets">
                <div class="widget">
                    <div class="widget-content padding"> 
                         <p>
        <?= Html::a('Registrar Hecho Violento', ['create'], ['class' => 'btn btn-success']) ?>
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
