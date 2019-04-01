<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * AdminLte asset bundle.
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/components/font-awesome';
    public $css = [
        'css/fontawesome-all.min.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
