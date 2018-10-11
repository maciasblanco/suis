<?php  

namespace app\controllers;

use Yii;
use mdm\admin\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\DatosPersona;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller 
{
    /**
     * @inheritdoc
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
            'access' => [
                'class'=>'mdm\admin\components\AccessControl',
                'allowActions' => ['error', 'captcha', 'prueba', 'create'],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'reg';

        $roles = (new \yii\db\Query)
          ->select(['name'])
          ->from('seguridad.auth_item')
          ->where(['type'=>1])
          ->andWhere(['not in', 'name', ['Desarrollador', 'Administrador', 'CDI']])
          ->all();

        if ($model->load(Yii::$app->request->post())) {
          if ($model->validate()){
            $model->setPassword($model->own_clave);
            $model->generateAuthKey();

            if ($model->save()) {
              (new \yii\db\Query)
                ->createCommand()
                ->delete('seguridad.auth_assignment', [
                  'user_id'=>$model->id,
                  ])
                ->execute();

              (new \yii\db\Query)
                ->createCommand()
                ->insert('seguridad.auth_assignment', [
                  'item_name'=>$model->own_rol,
                  'user_id'=>$model->id,
                  'created_at'=>strtotime(date('d-m-Y h:i:s')),
                  ])
                ->execute();

              if ($model->own_rol == 'CDI') {
                if ($model->own_cdi != '') {
                  (new \yii\db\Query)
                    ->createCommand()
                    ->insert('seguridad.usuario_cdi', [
                      'id_cdi'=>$model->own_cdi,
                      'id_usuario'=>$model->id,
                      ])
                    ->execute();
                }
              }

              return $this->redirect(['view', 'id' => $model->id]);
            }
          }
        }

        return $this->render('create', [
            'model' => $model,
            'roles' => $roles,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'act';

        $own_rol = (new \yii\db\Query)
          ->select(['item_name'])
          ->from('seguridad.auth_assignment')
          ->where(['user_id'=>$model->id])
          ->scalar();

        $model->own_rol = $own_rol;

        $roles = (new \yii\db\Query)
          ->select(['name'])
          ->from('seguridad.auth_item')
          ->where(['type'=>1])
          ->andWhere(['not in', 'name', ['Desarrollador', 'Administrador', 'CDI']])
          ->all();

        if ($model->load(Yii::$app->request->post())) {
          if ($model->validate()) {
            if ($model->own_clave != '')
              $model->setPassword($model->own_clave);

            if ($model->save()) {
              (new \yii\db\Query)
                ->createCommand()
                ->delete('seguridad.auth_assignment', [
                  'user_id'=>$model->id,
                  ])
                ->execute();

              (new \yii\db\Query)
                ->createCommand()
                ->insert('seguridad.auth_assignment', [
                  'item_name'=>$model->own_rol,
                  'user_id'=>$model->id,
                  'created_at'=>strtotime(date('d-m-Y h:i:s')),
                  ])
                ->execute();

              return $this->redirect(['view', 'id' => $model->id]);
            }
          }
        }

        return $this->render('update', [
          'model' => $model,
          'roles' => $roles,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      $model = $this->findModel($id);
      $model->status = User::STATUS_INACTIVE;
      $model->save(FALSE, ['status']);

      return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Validar usuario para dar permiso de actualizar solicitudes
     */
    public function actionPermisoActSoli($ope='actSoli'){
    	$data = Yii::$app->request->post('data');
    	
    	if (Yii::$app->request->post('ope') != NULL)
    		$ope = Yii::$app->request->post('ope');

    	if ($data != NULL){
    		$data = base64_decode($data);
    		$datos = json_decode($data);

    		$datos->clave = base64_decode($datos->pass);
    		
    		$usu = User::findByUsername($datos->usu);

    		if ($usu != NULL) {
    			$valido = $usu->validatePassword($datos->clave);
    			
    			if ($valido) {
    				$res = (new \yii\db\Query)->select('*')
                ->from('seguridad.auth_assignment aa')
                ->innerJoin('seguridad.user u', 'u.id = aa.user_id::integer')
                ->where(['u.username'=>$usu->username])
                ->andWhere(['aa.item_name'=>'Despacho'])
                ->one();

            if ($res != NULL) {
            	if ($ope == 'actSoli') {
	            	$permi = new \app\models\HPermisoActSoli([
	            		'id_usuario'=>Yii::$app->user->identity->id,
	            		'id_solicitud'=>$datos->key,
	            		'id_supervisor'=>$usu->id,
	            	]);
	            	if ($permi->save()){
	            		return TRUE;
	            	}
            	} else {
            		return TRUE;
            	}	
            }
    			}
    		}
    	}
    	return FALSE;
    }
}
