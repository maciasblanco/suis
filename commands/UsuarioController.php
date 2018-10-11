<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UsuarioController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionCrear()
    {
      $letras = [];
      $let = 'a';

      for ($i=0; $i<=25; $i++)
        $letras[] = $let++;

      $archivo = fopen('archivo.txt', 'w');

      for ($i=1; $i<=1; $i++){
        $clave = rand(10, 99).$letras[rand(0,25)].rand(10, 99).$letras[rand(0,25)].rand(10, 99);
        $model = new \mdm\admin\models\User(['username'=>'sala'.$i]);
        $model->setPassword($clave);
        $model->generateAuthKey();
        $model->own_rol = 'Sala';
        
        if ($model->save()){
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

          fwrite($archivo, $model->username.'|'.$clave.PHP_EOL);
        }
        else{
          var_dump($model->getErrors());
        }
      }

      fclose($archivo);
    }
}
