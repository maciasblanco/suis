<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * JuqeryUI asset bundle.
 */
class JqueriUiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower-asset/jquery-ui';
    public $css = [
        'themes/base/jquery-ui.min.css',
    ];
    public $js = [
        'jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
    ];
}
