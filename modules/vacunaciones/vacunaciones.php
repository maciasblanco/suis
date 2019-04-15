<?php

namespace app\modules\vacunaciones;

/**
 * vacunaciones module definition class
 */
class vacunaciones extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\vacunaciones\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
         \Yii::configure($this, require __DIR__ . '/config.php');
    }
}
