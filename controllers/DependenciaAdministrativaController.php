<?php

namespace app\controllers;

use app\models\DependenciaAdministrativa;
use yii;

class DependenciaAdministrativaController extends \yii\web\Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-by-term']
            ],
        ];
    }

    public function actionGetByTerm($term)
    {
        $results = DependenciaAdministrativa::find()
        	->where([
        		'or',
        		['ilike', 'codigo', $term],
        		['ilike', 'nombre', $term],
        	])
        	->limit( Yii::$app->params['optionsByAjaxLimit'] )
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
