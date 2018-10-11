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
class CitaController extends Controller
{
    /**
     * Coloca en FALSO la asistencia de las citas pasadas
     */
    public function actionSetFalse()
    {
        $query = (new \yii\db\Query)
          ->createCommand()
          ->update(\app\models\Cita::tableName(), [
            'asistio'=>FALSE
            ], [
              ['<', 'fecha', '2017-09-16'],
              ['asistio'=>NULL]
            ])
          ->execute();
    }
}
