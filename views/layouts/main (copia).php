<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use mdm\admin\components\MenuHelper;

header('X-Frame-Options: DENY');

AppAsset::register($this);

$menuCallback = function($menu){
  //Transforma de datos binarios a un string
  $data = ($menu['data'] != NULL) ? fgets($menu['data']) : FALSE;

  //Transforma de un string a un objeto/array
  if ($data)
    $data = eval($data);

  $opt = [
    'label' => $menu['name'], 
    'url' => [$menu['route']],
    'items' => $menu['children']
  ];

  if ($data){
    if (isset($data['linkOptions'])){
      $opt['linkOptions'] = $data['linkOptions'];
      unset($data['linkOptions']);
    }

    $opt['options'] = $data;
  }

  return $opt;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   
    <img src="<?=Yii::getAlias('@web')?>/imagenes/zamora.png" class="banner">								
    <?php
    NavBar::begin([
        //'brandLabel' => 'Somos 100% Salud Ya',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => array_merge(MenuHelper::getAssignedMenu(Yii::$app->user->id, NULL, $menuCallback), [
           // ['label'=>'Vademecum', 'url'=>'http://ve.prvademecum.com/', 'linkOptions'=>['target'=>'_blank']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Iniciar Sesión', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
            ]),
    ]);
    NavBar::end();
    ?>  
	
   <div class="container">
        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message): ?>
            <div class="alert alert-<?=$key?>"><?=$message?></div>
        <?php endforeach; ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
