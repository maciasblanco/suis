<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Enfermera;
use app\models\Medico;

class PersonalSaludController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-medico', 'get-enfermera']
            ],
        ];
    }

    /**
     * @return Json Datos de los medicos
     */
    public function actionGetMedico($term)
    {
        $medicos = Medico::find()
            ->select(['id', 'cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'])
            ->distinct()
            ->andWhere([
                'or',
                ['ilike', '(cedula::character varying)', $term],
                ['ilike', 'primer_nombre', $term],
                ['ilike', 'segundo_nombre', $term],
                ['ilike', 'primer_apellido', $term],
                ['ilike', 'segundo_apellido', $term],
            ])
            ->orderBy('primer_apellido')
            ->limit(20)
            ->all();

        $response = [];

        if (!empty($medicos)) {
            foreach ($medicos as $med) {
                $response[] = [
                    'id' => $med->id,
                    'text' => $med->cedulaYNombreCompleto,
                ];
            }
        }

        echo json_encode(['results' => $response]);
        exit;
    }

    /**
     * @return Json Datos de los medicos
     */
    public function actionGetEnfermera($term)
    {
        $enfermeras = Enfermera::find()
            ->select(['id', 'cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'])
            ->distinct()
            ->andWhere([
                'or',
                ['ilike', '(cedula::character varying)', $term],
                ['ilike', 'primer_nombre', $term],
                ['ilike', 'segundo_nombre', $term],
                ['ilike', 'primer_apellido', $term],
                ['ilike', 'segundo_apellido', $term],
            ])
            ->orderBy('primer_apellido')
            ->limit(20)
            ->all();

        $response = [];

        if (!empty($enfermeras)) {
            foreach ($enfermeras as $enfer) {
                $response[] = [
                    'id' => $enfer->id,
                    'text' => $enfer->cedulaYNombreCompleto,
                ];
            }
        }

        echo json_encode(['results' => $response]);
        exit;
    }
}