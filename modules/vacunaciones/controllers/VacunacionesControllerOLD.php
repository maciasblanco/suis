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
    public function actionPrecargaEstablecimiento($cod = null)
    {
        if ($cod == null) {
            exit;
        }

        $est = \app\models\Establecimiento::find()
            ->where(['codigo' => $cod])
            ->andWhere(['htipo' => [70276, 70277, 70278, 70279, 70280, 70284, 70285]])
            ->one();

        if ($est == null) {
            exit;
        }

        $queryRec = Yii::$app->bd_salud->createCommand("WITH RECURSIVE estructura_rec AS (
            SELECT geo.num_region, geo.cod_ocei, geo.des_region, geo.cod_categoria, geo.region_precedente
                FROM sys_configuracion.org_geografica geo
                JOIN sys_configuracion.establecimiento est ON geo.num_region = est.hlocalidad
                WHERE est.codigo = '{$est->codigo}'
            UNION
            SELECT padre.num_region, padre.cod_ocei, padre.des_region, padre.cod_categoria, padre.region_precedente
                FROM estructura_rec rec
                INNER JOIN sys_configuracion.org_geografica padre ON rec.region_precedente = padre.num_region
            )

            SELECT * FROM estructura_rec WHERE cod_categoria != 10
            ORDER BY cod_categoria ASC LIMIT 3");

        $res = $queryRec->queryAll();

        $respuesta = [];
        $respuesta['nombre'] = $est->nombre;
        $respuesta['e'] = $est->id;

        if (empty($res)) {
            exit(1);
        }

        $respuesta['n3'] = isset($res[0]) ? $res[0]['cod_ocei'] : null;
        $respuesta['n3txt'] = isset($res[0]) ? $res[0]['des_region'] : null;
        $respuesta['n2'] = isset($res[1]) ? $res[1]['cod_ocei'] : null;
        $respuesta['n2txt'] = isset($res[1]) ? $res[1]['des_region'] : null;
        $respuesta['n1'] = isset($res[2]) ? $res[2]['cod_ocei'] : null;
        $respuesta['n1txt'] = isset($res[2]) ? $res[2]['des_region'] : null;

        echo json_encode($respuesta);
        exit;
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
