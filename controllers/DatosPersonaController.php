<?php

namespace app\controllers;

use Yii;
use app\models\DatosPersona;
use app\models\Nacionalidad;
use app\models\Sexo;
use yii\web\Controller;

class DatosPersonaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'only' => ['get-by-ci-nac'],
            ],
        ];
    }

    /**
     * Get options for Select2 dropdown
     */
    public function actionGetByCiNac($ci, $nac)
    {
        $per = DatosPersona::find()
            ->where(['cedula' => $ci, 'id_nacionalidad' => $nac])
            ->one();

        $response = ($per == null) ? [] : [
            'id_nacionalidad' => $per->id_nacionalidad,
            'cedula' => $per->cedula,
            'primer_nombre' => $per->primer_nombre,
            'segundo_nombre' => $per->segundo_nombre,
            'primer_apellido' => $per->primer_apellido,
            'segundo_apellido' => $per->segundo_apellido,
            'id_sexo' => $per->id_sexo,
            'fecha_nac' => $per->fecha_nac,
            'id_parroquia' => $per->id_parroquia,
            'codigo_municipio' => ($per->parroquia) ? $per->parroquia->codigo_municipio : null,
            'codigo_estado' => ($per->parroquia && $per->parroquia->municipio) ? $per->parroquia->municipio->codigo_estado : null,
        ];

        if (empty($response)) {
            $nacCond = ($nac == Nacionalidad::V) ? 'V' : 'E';

            $query = (new \yii\db\Query)
                ->select('primer_apellido, segundo_apellido, primer_nombre, 
                    segundo_nombre, fecha_nacimiento, sexo, letra AS nacionalidad')
                ->from('saime')
                ->where(['cedula'=>$ci, 'letra'=>$nacCond]);

            $res = $query->one(Yii::$app->db_saime);

            if ($res) {
                $response = [
                    'id_nacionalidad' => $nac,
                    'cedula' => $ci,
                    'primer_nombre' => $res['primer_nombre'],
                    'segundo_nombre' => $res['segundo_nombre'],
                    'primer_apellido' => $res['primer_apellido'],
                    'segundo_apellido' => $res['segundo_apellido'],
                    'id_sexo' => ($res['sexo'] == 'F') ? Sexo::F : Sexo::M,
                    'fecha_nac' => date('d-m-Y', strtotime($res['fecha_nacimiento'])),
                ];
            }
        }

        echo json_encode($response);
        exit;
    }
}
