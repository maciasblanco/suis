<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\SemanaEpidemiologica;

class SemanaEpidemiologicaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-semana-por-fecha']
            ],
        ];
    }

    /**
     * @return 
     */
    public function actionGetSemanaPorFecha($fecha)
    {
        $anio = date('Y', strtotime($fecha));

        $semanas = SemanaEpidemiologica::find()
            ->where(['anio' => $anio])
            ->orderBy('semana')
            ->all();

        $response = [];

        if (!empty($semanas)) {
            foreach ($semanas as $row) {
                $response[] = [
                    'id' => $row->id,
                    'text' => $row->semanaYFechas,
                ];
            }
        }

        echo json_encode(['results' => $response]);
        exit;
    }
}