<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Fix adminlte issues
 *
 */
class FixedAdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fix.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AdminLteAsset'
    ];
}
