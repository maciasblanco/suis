<?php

namespace app\controllers;

use app\models\Cie10Categoria;
use app\models\Cie10Subcategoria;
use yii;

class Cie10SubcategoriaController extends \yii\web\Controller
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-codigo-descripcion']
            ],
        ];
    }

    /**
     * Get options for Select2 dropdown
     */
    public function actionGetCodigoDescripcion($term)
    {
        $results = Cie10Subcategoria::find()
            ->from(
                Cie10Subcategoria::find()
                ->where([
            		'or',
            		['ilike', 'codigo', $term],
            		['ilike', 'descripcion', $term],
            	])
                ->union(
                    Cie10Subcategoria::find()
                        ->alias('t')
                        ->joinWith(['cie10Categoria cate'])
                        ->where([
                            'or',
                            ['ilike', 'cate.codigo', $term],
                            ['ilike', 'cate.descripcion', $term], 
                        ])
                        ->andWhere(['t.codigo' => ''])
                )
                ->union(
                    Cie10Subcategoria::find()
                        ->alias('t')
                        ->joinWith(['cie10Categoria cate', 'cie10Categoria.cie10Grupo grupo'])
                        ->where([
                            'or',
                            ['ilike', 'grupo.codigo', $term],
                            ['ilike', 'grupo.descripcion', $term], 
                        ])
                        ->andWhere(['t.codigo' => '', 'cate.codigo' => ''])
                )
            )
        	->limit( Yii::$app->params['optionsByAjaxLimit'] )
        	->all();

        $response = [];

        if (!empty($results)) {
        	foreach ($results as $row) {
        		$response[] = [
        			'id' => $row->id,
        			'text' => $row->codigoDescripcion,
        		];
        	}
        }

        echo json_encode(['results' => $response]);
        exit;
    }
}
