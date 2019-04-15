<?php

namespace app\modules\vacunaciones\controllers;

use Yii;
use app\modules\vacunaciones\models\DatosPersona;
use app\modules\vacunaciones\models\Vacunaciones;
use app\modules\vacunaciones\models\VacunacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacunacionesController implements the CRUD actions for Vacunaciones model.
 */
class VacunacionesController extends Controller
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
     * Lists all Vacunaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacunacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacunaciones model.
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
     * Creates a new Vacunaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacunaciones();
        $modelperso = new DatosPersona();
        //$modelmenor = new MenorEdad();

        if ($model->load(Yii::$app->request->post()) && $modelperso->load(Yii::$app->request->post())) {
            //$model->save();
            

          $erroresModelo = $model->getErrors();

          unset($erroresModelo['id_dato_persona']);
            //var_dump($model->getErrors());die;
          if (empty($erroresModelo) && $modelperso->validate()) {

              $transaccion = Yii::$app->db->beginTransaction();
                //var_dump($modelperso->save());die;
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
          else {
            /*var_dump($modelperso->getErrors(),$erroresModelo);
            die;*/

          }


        
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelperso' => $modelperso,
        ]);
    }

    /**
     * Updates an existing Vacunaciones model.
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
     * Deletes an existing Vacunaciones model.
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
     * Finds the Vacunaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vacunaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacunaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
