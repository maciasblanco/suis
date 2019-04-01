<?php

namespace app\controllers;

use Yii;
use app\models\Parroquia;
use yii\web\Controller;

class ParroquiaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-by-muni']
            ],
        ];
    }

    /**
     * Get options for Select2 dropdown
     */
    public function actionGetByMuni($muni)
    {
        $results = Parroquia::find()
            ->where(['codigo_municipio' => $muni])
            ->all();

        $response = [];

        if (!empty($results)) {
            foreach ($results as $row) {
                $response[] = [
                    'id' => $row->id_parroquia,
                    'text' => $row->parroquia,
                ];
            }
        }

        echo json_encode(['results' => $response]);
        exit;
    }

    public function actionList($id)
      {
          $countParroquia = Parroquia::find()
                      ->where(['codigo_municipio'=>$id])
                      ->count();

          $parroquias = Parroquia::find()
                  ->where(['codigo_municipio'=>$id])
                  ->all();

          if ($countParroquia > 0)
           {
              foreach ($parroquias as $parroquia) {
                  echo "<option value='".$parroquia->id_parroquia."'>".$parroquia->parroquia."</options>";
              }
          }
          else
          {
              echo "<option> No existen Parroquias Registradas </option>";
          }
      }
}
