<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Establecimiento;

class EstablecimientoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-by-edo']
            ],
        ];
    }
	/**
     *
     */
	public function actionGetEstablecimiento($term)
	{
        $establecimientos = Establecimiento::find()
        	->where([
        		'or',
        		['ilike', 'codigo', "{$term}%", false],
        		['ilike', 'nombre', $term],
        	])
			->orderBy('nombre')
			->limit(20)
			->all();

		$response = [];

		if (!empty($establecimientos)) {
			foreach ($establecimientos as $est) {
				$response[] = [
					'id' => $est->id,
					'text' => $est->nombreCompleto,
				];
			}
		}

		echo json_encode(['results' => $response]);
		exit;
	}

    /**
     * Get options for Select2 dropdown
     */
    public function actionGetAsicByEdo($edo)
    {
        $results = Establecimiento::find()
            ->where(['codigo_estado' => $edo])
            ->andWhere(['id_tipo_establecimiento' =>70320])
            ->all();

        $response = [];

        if (!empty($results)) {
            foreach ($results as $row) {
                $response[] = [
                    'id' => $row->id,
                    'text' => $row->nombreCompleto,
                ];
            }
        }

        echo json_encode(['results' => $response]);
        exit;
    }
}