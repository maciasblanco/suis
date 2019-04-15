<?php

namespace app\modules\athv\controllers;

use Yii;
use app\modules\athv\models\DatosPersonas;
use app\modules\ev25\models\DatosPersonasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DatosPersonasController implements the CRUD actions for DatosPersonas model.
 */
class DatosPersonasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DatosPersonas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DatosPersonasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DatosPersonas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DatosPersonas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DatosPersonas();

        if ($model->load(Yii::$app->request->post())) {
            //echo $model->nacionalidad; die;
        
            
          
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DatosPersonas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DatosPersonas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DatosPersonas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DatosPersonas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DatosPersonas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionConsulta($nac, $ci)
    {
        $query = (new \yii\db\Query)
        ->select('primer_apellido as "PRIMERAPELLIDO", segundo_apellido as "SEGUNDOAPELLIDO",primer_nombre as "PRIMERNOMBRE", 
            segundo_nombre as "SEGUNDONOMBRE",fechanac as "FECHANAC", sexo as "SEXO", nacionalidad As "NACIONALIDAD",
            telefono AS "TELEFONO" ')
        ->from('general.datos_persona')
        ->where(['cedula'=>$ci, 'nacionalidad'=>$nac]);

        $res = (object) ($query->one(Yii::$app->db));
        $var = [0=>$res];

        if(isset($var[0]->SEXO)){
            if ($var[0]->NACIONALIDAD == 1) {
                $var[0]->NACIONALIDAD  = 'V';
            } if ($var[0]->NACIONALIDAD == 2) {
                $var[0]->NACIONALIDAD = 'E';
            }
    
            if ($var[0]->SEXO == 1) {
                $var[0]->SEXO = 'F';
            } if ($var[0]->SEXO == 2) {
                $var[0]->SEXO = 'M';
            }
        }
        
        if($nac == 1){
            $nac = 'V';
        } if($nac == 2){
            $nac == 'E';
        }

        if(isset($res->scalar)) {
            $query = (new \yii\db\Query)
            ->select('primer_apellido as "PRIMERAPELLIDO", segundo_apellido as "SEGUNDOAPELLIDO",primer_nombre as "PRIMERNOMBRE", 
                segundo_nombre as "SEGUNDONOMBRE",fecha_nacimiento as "FECHANAC", sexo as "SEXO", letra As "NACIONALIDAD" ')
            ->from('saime')
            ->where(['cedula'=>$ci, 'letra'=>$nac]);

            $res = (object) ($query->one(Yii::$app->db_saime));
            $var = [0=>$res];
        }

        //list($Y, $m, $d) = explode("-", $var[0]->FECHANAC);
        //$var[0]->edad=(date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y);
        //$var[0]->FECHANAC = date('d-m-Y', strtotime($var[0]->FECHANAC));
        //var_dump($var);die;

        echo json_encode($var);
        
        exit;
    }

}
