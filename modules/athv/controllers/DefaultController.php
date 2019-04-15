<?php

namespace app\modules\athv\controllers;

use yii\web\Controller;

/**
 * Default controller for the `athv` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
