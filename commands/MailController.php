<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MailController extends Controller
{
  public function actionMail(){
    //Num de dias a sumar para llegar al sabado
    $interval = 2;

    //Prepara la estructura inicial del email
    $mail = Yii::$app->mailer->compose()
      ->setFrom('800somossaludya@gmail.com')
      ->setSubject('Reporte de solicitudes')
      //->setTextBody('Cuerpo del mensaje')
      ;

    //Busca todos los datos a utilizar
    $citas = (new \yii\db\Query)
      ->select([
        'cdi'=>'cdi.nombre', 'cdi.email', 
        'dp.cedula', 'dp.nombre', 'dp.apellido',
        'med'=>'med.med_orig', 
        'soli.cantidad',
        'patologia'=>'pat.descripcion'
        ])
      ->from(\app\models\Cita::tableName().' cita')
      ->innerJoin(\app\models\Cdi::tableName().' cdi', 'cdi.id = cita.id_cdi')
      ->innerJoin(\app\models\DatosPersona::tableName().' dp', 'dp.id = cita.id_datos_persona')
      ->innerJoin(\app\models\Solicitud::tableName().' soli', 'soli.id_datos_persona = dp.id')
      ->innerJoin(\app\models\Medicamento::tableName().' med', 'med.id = soli.id_medicamento')
      ->innerJoin(\app\models\Patologia::tableName().' pat', 'pat.id = soli.id_patologia')
      ->where(['NOT', ['cdi.email'=>'NULL']])
      ->andWhere("cita.fecha = (NOW()::date + INTERVAL '$interval days')::date")
      ->all();

    if (empty($citas))
      return FALSE;

    $dataMsj = [];
    
    //Estructura los datos
    foreach ($citas as $cita){
      $dataMsj[ $cita['email'] ][ $cita['cdi'] ][] = [
        'cedula'=>$cita['cedula'],
        'nombre'=>$cita['nombre'],
        'apellido'=>$cita['apellido'],
        'med'=>$cita['med'],
        'cant'=>$cita['cantidad'],
        'pat'=>$cita['patologia'],
        ];
    }

    //Genera cada correo
    foreach ($dataMsj as $email => $cdis) {
      $mail->setTo($email);
      $cuerpo = '';

      //Crea el cuerpo de cada correo
      foreach ($cdis as $cdi => $datos) {
        $tabla = "<table>
            <thead>
              <tr>
                <th>CDI</th>
                <th>CEDULA</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>MEDICAMENTO</th>
                <th>CANTIDAD</th>
                <th>PATOLOGIA</th>
              </tr>
            </thead>
            <tbody>";

        //Crea una fila por solicitud
        foreach ($datos as $soli) {
          $tabla .= "
              <tr>
                <td>$cdi</td>
                <td>{$soli['cedula']}</td>
                <td>{$soli['nombre']}</td>
                <td>{$soli['apellido']}</td>
                <td>{$soli['med']}</td>
                <td>{$soli['cant']}</td>
                <td>{$soli['pat']}</td>
              </tr>
            ";
        }

        $tabla .= "
            </tbody>
          </table>";

        //Anexa los datos del CDI al cuerpo del correo
        $cuerpo .= $tabla.'<br/>';
      }//Fin foreach $cdis

      $mail->setHtmlBody($cuerpo);
      $enviado = $mail->send();
    }//Fin foreach $dataMsj
  }
}
