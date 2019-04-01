<?php

namespace app\controllers;

use app\models\Cie10Grupo;
use yii;

class Cie10GrupoController extends \yii\web\Controller
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

    /**
     * Get options for Select2 dropdown
     */
    public function actionGetByTerm($term)
    {
        $results = Cie10Grupo::find()
        	->where([
        		'or',
        		['ilike', 'codigo', $term],
        		['ilike', 'descripcion', $term],
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
