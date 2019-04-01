<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\components\MenuComponent;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

\app\assets\FixedAdminLteAsset::register($this);
\app\assets\FontAwesomeAsset::register($this);

//Page title
$this->title = Yii::$app->name . ' - ' . $this->title;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="stylesheet" type="text/css" href="<?= Yii::getAlias('@web') ?>/css/metro.css">
    <link rel="stylesheet" type="text/css" href="<?= Yii::getAlias('@web') ?>/css/metro_mobile.css" media="screen and (max-height: 400px), screen and (orientation:portrait)">
    <script type="text/javascript" src="<?= Yii::getAlias('@web') ?>/js/metro.js"></script>
    <?php $this->head() ?>

    <style>
        #widget_scroll_container {
            position:relative;
        }
        /*#widget_scroll_container {
            width: 2160px;
        }
        div.widget_container {
            width: 1200px;
        }
        div.widget_container.half {
            width: 400px;
        }
        @media screen and (max-height: 680px) {
            #widget_scroll_container {
                width: 1660px;
            }
            div.widget_container {
                width: 900px;
            }
            div.widget_container.half {
                width: 300px;
            }
        }*/
    </style>
</head>
<body class="hold-transition skin-suis sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><i class="fas fa-stethoscope"></i></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <i class="fas fa-stethoscope"></i>
                    <?= Yii::$app->name ?>
                </span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li class="dropdown user user-menu">
                                <a href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>">
                                    <span class="fa fa-sign-in"></span>
                                    <span class="hidden-xs">
                                        <?= Yii::t('app', 'Login') ?>
                                    </span>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="dropdown user user-menu">
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs">
                                        <?= Yii::t('app', 'User') ?>:
                                        <b><?= Yii::$app->user->identity->username ?></b>
                                    </span>
                                </a>
                            </li>
                            <li class="dropdown user user-menu">
                                <?= Html::beginForm(['/site/logout'], 'post', [
                                    'style' => 'display:none',
                                    'id' => 'logout-form',
                                ]) ?>
                                <?= Html::endForm() ?>
                                <a href="#" onclick='$("#logout-form").submit()'>
                                    <span class="fa fa-sign-out"></span>
                                    <span class="hidden-xs">
                                        <i class="fas fa-power-off"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="hidden-xs">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/logos/banner.png" alt="Logo">
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php if (isset($this->blocks['contentHeader'])): ?>
                    <?= $this->blocks['contentHeader'] ?>
                <?php else: ?>
                    <h1>&nbsp;</h1>
                <?php endif; ?>

                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('app', 'Home'),
                        'url' => Yii::$app->homeUrl,
                        'template' => '<li><i class="fa fa-home"></i> {link}</li>',
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message): ?>
                            <div class="alert alert-<?= $key ?> alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?= $message ?>
                            </div>
                        <?php endforeach; ?>

                        <?= $content ?>
                    </div>
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer"></footer>
    </div>
    <!-- ./wrapper -->
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
