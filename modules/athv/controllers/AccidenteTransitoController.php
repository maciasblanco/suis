<?php

namespace app\modules\athv\controllers;

use Yii;
use app\modules\athv\controllers\DatosPersonasController;
use app\modules\athv\models\DatosPersonas;
use app\modules\athv\models\AccidenteTransito;
use app\modules\athv\models\AccidenteTransitoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccidenteTransitoController implements the CRUD actions for AccidenteTransito model.
 */
class AccidenteTransitoController extends Controller
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
     * Lists all AccidenteTransito models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccidenteTransitoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccidenteTransito model.
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
     * Creates a new AccidenteTransito model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccidenteTransito();
        $modelperso = new DatosPersonas();

        if ($model->load(Yii::$app->request->post()) && $modelperso->load(Yii::$app->request->post()))
        {
            $model->validate();

            $erroresModelo = $model->getErrors();

            unset($erroresModelo['id_dato_persona']);

            if ($modelperso->nacionalidad == 'V') {
                $modelperso->nacionalidad = 1;
            } if ($modelperso->nacionalidad == 'E') {
                $modelperso->nacionalidad = 2;
            }
    
            if ($modelperso->sexo == 'F') {
                $modelperso->sexo = 1;
            } if ($modelperso->sexo == 'M') {
                $modelperso->sexo = 2;
            }

            if (empty($erroresModelo) && $modelperso->validate()) {

                $transaccion = Yii::$app->db->beginTransaction();

                $query = (new \yii\db\Query)
                ->select('*')
                ->from('general.datos_persona')
                ->where(['cedula'=>$modelperso->cedula, 'nacionalidad'=>$modelperso->nacionalidad]);
                $res = (object) ($query->one(Yii::$app->db));
                $var = [0=>$res];

                if (!isset($var[0]->cedula)){

                    if ($modelperso->save()) {
                        $model->id_dato_persona = $modelperso->id;
                        if ($model->save()) {
                            $transaccion->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                        else {
                            $transaccion->rollBack();
                        }
                    }
                    else {
                        $transaccion->rollBack();
                    }
                }
                else{

                    $model->id_dato_persona = $var[0]->id;
                    if ($model->save()) {
                        $transaccion->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            else {
              //var_dump($modelperso->getErrors(),$erroresModelo); die;
            }
            if ($model->save()) {
                $model->id_dato_persona = $modelperso->id;
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelperso' => $modelperso,
        ]);
    }

    /**
     * Updates an existing AccidenteTransito model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelperso = DatosPersonas::find()->where("id = $model->id_dato_persona")->one();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelperso' => $modelperso,
        ]);
    }

    /**
     * Deletes an existing AccidenteTransito model.
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
     * Finds the AccidenteTransito model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccidenteTransito the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccidenteTransito::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
