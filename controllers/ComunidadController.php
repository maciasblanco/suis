<?php

namespace app\controllers;

use Yii;
use app\models\Comunidad;
use yii\web\Controller;

/**
 * MunicipioController implements the CRUD actions for Municipio model.
 */
class ComunidadController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-by-parro']
            ],
        ];
    }

    /**
     * Get options for Select2 dropdown
     */
    public function actionGetByParro($parro)
    {
        $results = Comunidad::find()
            ->where(['id_parroquia' => $parro])
            ->all();

        $response = [];

        if (!empty($results)) {
            foreach ($results as $row) {
                $response[] = [
                    'id' => $row->id,
                    'text' => $row->comunidad,
                ];
            }
        }

        echo json_encode(['results' => $response]);
        exit;
    }
}
