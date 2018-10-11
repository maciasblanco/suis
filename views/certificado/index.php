<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CertificadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Certificados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Certificado', ['create'], ['class' => 'btn btn-success']) ?>
        
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

             [
                'attribute'=>'id_establecimiento',
                'value'=>function($model){
                    return $model->idEstablecimiento->nombre;
                }
            ],
            'num_historia',
            [
                'attribute'=>'id_centro',
                'value'=>function($model){
                    return $model->idCentro->nombre;
                }
            ],
            [
                'attribute'=>'codigo_estado',
                'value'=>function($model){
                    return $model->codigoEstado->estado;
                }
            ],
            // 'codigo_municipio',
            // 'codigo_paroquia',
            // 'codigo_comunidad',
            // 'direccion',
            // 'id_madre',
            // 'id_padre',
            // 'fecha',
            // 'hora',
            // 'semana_gestacion',
            // 'talla',
            // 'peso',
            // 'resp_cedula',
            // 'resp_reg',
            // 'resp_nomb',
            // 'id_sexo',
            // 'nombre',
            // 'apellido',
            // 'codigo',
            // 'id_malformacion_cong',
            // 'perimetro_cefalico',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {pdfReg}',
                'buttons'=>[
                    'pdfReg' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, [
                    'title' => Yii::t('app', 'pdf'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'pdfReg') {
                        $url =(Yii::$app->urlManager->createUrl(["/ev25/certificado/pdf",'id'=>$model->id]));
                        return $url;
                    }
                    if ($action === 'view') {
                        $url =(Yii::$app->urlManager->createUrl(["/ev25/certificado/view",'id'=>$model->id]));
                        return $url;
                    }
                    if ($action === 'update') {
                        $url =(Yii::$app->urlManager->createUrl(["/ev25/certificado/update",'id'=>$model->id]));
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>
</div>
