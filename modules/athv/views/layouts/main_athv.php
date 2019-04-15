<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use common\widgets\Alert;
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
};

$opcMenu = array_merge(MenuHelper::getAssignedMenu(Yii::$app->user->id, 14, $menuCallback), [ //34
	[
        	'label' => Yii::$app->user->isGuest ? 'Iniciar Sesión' : 'Cerrar Sesión',
		'url' => Yii::$app->user->isGuest ? ['/site/login'] : ['/site/logout']
	]
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/img/logos/logo.png">
    <?php $this->head() ?>
</head>

<body class="fixed-left">
<?php $this->beginBody() ?>

<div id="wrapper">
    <!-- Top Bar Start -->
    <header class="navbar navbar-fixed-top">
        <div class="topbar">
            <div class="topbar-left">
                <div class="logo" id="athv">
                  <h1><?php echo Html::a
                      ('<img src="'.Yii::$app->request->baseUrl.'/img/logos/athv.png" alt="Logo">',
                      ['/site/index']);
                  ?></h1>
                </div>
                <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation" style="background:#C10B19;">
                <div class="container">
                    <div class="navbar-collapse2">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a class="topbar-menu-toggle" href="#">
                                    <span class="octicon octicon-ruby fs18"></span>
                                </a>
                            </li>
                            <li class="hidden-xs">
                                <a class="request-fullscreen toggle-active" href="#" onclick="javascript:toggle_fullscreen()">
                                    <span class="octicon octicon-screen-full fs18"></span>
                                </a>
                            </li>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden-xs">
                                <img src="<?= Yii::$app->request->baseUrl; ?>/img/logos/banner.png" alt="Logo">
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </header>
    <!-- Top Bar End -->

    <!-- Left Sidebar Start -->
    <div class="left side-menu darkside" id="side-menu">
        <div class="sidebar-inner slimscrollleft" style="">
            <!--- Profile -->
            <div class="profile-info">
                <div class="col-xs-4">
                    <a class="rounded-image profile-image"><img src="<?= Yii::$app->request->baseUrl; ?>/img/logos/logo_mpps.png" alt="avatar"> </a>
                </div>
                <div class="col-xs-8">
                    <div class="profile-text">Bienvenido,<br/><b>Nombre Usuario</b></div>
                    <div class="profile-buttons">
                        <a class="open-right"><span class="octicon octicon-graph"></span>
                        <?php echo Html::a ('<i class="fa fa-user-circle"></i>',
                            ['/usuario/cambiar-clave'],
                            ['title'=>'Perfil']); ?>
                      <?php echo Html::a ('<i class="fa fa-power-off text-red-1"></i>',
                        ['/site/logout'],
                        ['title'=>'Cerrar Sesión']); ?>
                    </div>
                </div>
            </div>
            <!--- Divider -->
            <div class="clearfix"></div>
            <hr class="divider" />
            <!--- Divider -->
            <div id="sidebar-menu">
                <ul>
                  <?php if (isset($this->blocks['blockMenus'])): ?>
                  <?= $this->blocks['blockMenus'] ?>
                  <?php else: ?>
                  <?php foreach ($opcMenu as $opc): ?>
                  <li class="has_sub">
                      <a href="<?= $opc['url'][0] != NULL ? Yii::$app->urlManager->createUrl($opc['url'][0]) : '#' ?>">
                        <?= $opc['label'] ?>
                        <?php if (!empty($opc['items'])): ?>
                          <ul style="display: none">
                            <?php foreach ($opc['items'] as $subopc): ?>
                              <li class="has_sub">
                                <a class="mostrar" href="<?= Yii::$app->urlManager->createUrl($subopc['url'][0])?>">
                                    <?= $subopc['label'] ?>
                                </a>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                      </a>
                  </li>
              <?php endforeach; ?>
              <?php endif; ?>
                <!--<li class='has_sub'>
                        <a href='javascript:void(0);'><i class='fa fa-circle-o-notch'></i><span> Tour</span></a>
                    </li>-->
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div><br><br><br>
        </div>
        <div class="left-footer">
            <?php /*<img src="<?= Yii::$app->request->baseUrl; ?>/img/logos/maduro.png" alt="MaduroEsPueblo">*/ ?>
        </div>
    </div>

    <section id="content_wrapper">
        <!-- Start: Topbar-Dropdown -->
        <div id="topbar-dropmenu">
            <div class="topbar-menu row">
                  <div class="col-xs-4 col-sm-1">
                      <?php echo Html::a ('<span class="metro-icon fa fa-user-plus"></span><p class="metro-title">MORBILIDAD</p>',
                          ['/datos-persona/create'],
                          ['class'=>'metro-tile']); ?>
                  </div>
                  <div class="col-xs-4 col-sm-1">
                    <?php echo Html::a ('<span class="metro-icon fa fa-archive"></span><p class="metro-title">NATALIDAD</p>',
                        ['/solicitud/index'],
                        ['class'=>'metro-tile']);?>
                </div>
                <div class="col-xs-4 col-sm-1">
                    <?php echo Html::a ('<span class="metro-icon fa fa-truck"></span><p class="metro-title">MORTALIDAD</p>',
                        ['/recepcion/index'],
                        ['class'=>'metro-tile']); ?>
                </div>
                <div class="col-xs-4 col-sm-1">
                    <?php echo Html::a ('<span class="metro-icon fa fa-medkit"></span><p class="metro-title">INMUNIZACIONES</p>',
                        ['/inventario/index'],
                        ['class'=>'metro-tile']); ?>
                </div>
                <div class="col-xs-4 col-sm-1">
                  <?php echo Html::a ('<span class="metro-icon fa fa-users"></span><p class="metro-title">FICHAS</p>',
                      ['/usuario/index'],
                      ['class'=>'metro-tile']); ?>
                </div>
                <div class="col-xs-4 col-sm-1">
                  <?php echo Html::a ('<span class="metro-icon fa fa-ioxhost"></span><p class="metro-title">ONCOLOGIA</p>',
                      ['/estadistica/index'],
                      ['class'=>'metro-tile']); ?>
                </div>
                  <div class="col-xs-4 col-sm-1">
                  <?php echo Html::a ('<span class="metro-icon fa fa-ioxhost"></span><p class="metro-title">ACCIDENTES</p>',
                      ['/estadistica/index'],
                      ['class'=>'metro-tile']); ?>
                </div>
                <div class="col-xs-4 col-sm-1">
                  <?php echo Html::a ('<span class="metro-icon fa fa-ioxhost"></span><p class="metro-title">CIRUGIA</p>',
                      ['/estadistica/index'],
                      ['class'=>'metro-tile']); ?>
                </div>
                <div class="col-xs-4 col-sm-1">
                  <?php echo Html::a ('<span class="metro-icon fa fa-ioxhost"></span><p class="metro-title">SIGEMED</p>',
                      ['/estadistica/index'],
                      ['class'=>'metro-tile']); ?>
                </div>
                <div class="col-xs-4 col-sm-1">
                  <?php echo Html::a ('<span class="metro-icon fa fa-ioxhost"></span><p class="metro-title">POR DEFINIR</p>',
                      ['/estadistica/index'],
                      ['class'=>'metro-tile']); ?>
                </div>
            </div>
        </div>
        <!-- End: Topbar-Dropdown -->

    </section>

    <!-- Right Sidebar Start -->
    <div class="right side-menu">

        <ul class="nav nav-tabs nav-justified" id="right-tabs">
          <li class="active"><a href="#feed" data-toggle="tab" title="Live Feed"><i class="icon-rss-2"></i></a></li>
          <li><a href="#connect" data-toggle="tab" title="Chat"><i class="icon-chat"></i></a></li>
          <li><a href="#settings" data-toggle="tab" title="123"><i class="fa fa-id-card-o"></i></a></li>
        </ul>

        <div class="clearfix"></div>

        <div class="tab-content">
            <div class="tab-pane active" id="feed">
                <div class="tab-inner slimscroller">
                    <div class="search-right">
                    </div>
                    <div class="clearfix"></div>

                    <div class="panel-group" id="collapse">
                      <div class="panel panel-default">
                        <div class="panel-heading bg-orange-1">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#rnotifications">
                              <i class="icon-bell-2"></i> Boletines
                              <span class="label bg-darkblue-1 pull-right">4</span>
                            </a>
                          </h4>
                        </div>
                        <div id="rnotifications" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <ul class="list-unstyled" id="notification-list">
                                <li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-video"></i></span> SEMANA Nº 29 <span class="muted">LUNES-VIERNES</span></a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-users-1"></i></span> SEMANA Nº 30 <span class="muted">LUNES-VIERNES</span></a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-picture-1"></i></span> SEMANA Nº 31 <span class="muted">LUNES-VIERNES</span></a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper"><i class="icon-hourglass-1"></i></span> SEMANA Nº 32 <span class="muted">LUNES-VIERNES</span></a></li>
                            </ul>
                            <a class="btn btn-block btn-sm btn-success">VER TODOS</a>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading bg-green-3">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#remails">
                              <i class="icon-mail"></i> Anuarios
                              <span class="label bg-darkblue-1 pull-right">10</span>
                            </a>
                          </h4>
                        </div>
                        <div id="remails" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <ul class="list-unstyled" id="inbox-list">
                                <li><a href="javascript:;"><span class="sender"><i class="icon-star text-yellow-2"></i> AÑO 2009</span> <span class="datetime">6 mins ago</span>
                                    <span class="title">Titulo</span>
                                    <span class="content">Descripcion</span>
                                </a></li>
                                <li><a href="javascript:;"><span class="sender">AÑO 2010</span> <span class="datetime">13 hours ago</span>
                                  <span class="title">Titulo</span>
                                  <span class="content">Descripcion</span>
                                </a></li>
                                <li><a href="javascript:;"><span class="sender">AÑO 2011</span> <span class="datetime">Yesterday</span>
                                  <span class="title">Titulo</span>
                                  <span class="content">Descripcion</span>
                                </a></li>
                            </ul>
                            <a class="btn btn-block btn-sm btn-danger">VER TODOS</a>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading bg-orange-1">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#rupdates">
                              <i class="icon-signal-2"></i> Indicadores
                              <span class="label bg-darkblue-1 pull-right">5</span>
                            </a>
                          </h4>
                        </div>
                        <div id="rupdates" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <ul class="list-unstyled" id="updates-list">
                                <li><a href="javascript:;"><span class="icon-wrapper bg-green-1"><i class="icon-comment-1"></i></span> <b>Indicador 1</b> Titulo <abbr title="15 seconds ago">Descripción</abbr>.</a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper bg-red-1"><i class="icon-user-3"></i></span> <b>Indicador 2</b> Titulo <abbr title="4 mins ago">Descripción</abbr>.</a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper bg-blue-1"><i class="icon-twitter-2"></i></span> <b>Indicador 3</b> Titulo <abbr title="22 mins ago">Descripción</abbr>.</a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper bg-orange-3"><i class="icon-water"></i></span> <b>Indicador 4</b> Titulo <abbr title="43 mins ago">Descripción</abbr>.</a></li>
                                <li><a href="javascript:;"><span class="icon-wrapper bg-pink-2"><i class="icon-heart-broken"></i></span> <b>Indicador 5</b>Titulo<abbr title="3 hours ago">Descripción</abbr>.</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="connect">
                <div class="tab-inner slimscroller">
                    <div class="search-right">
                    </div>
                    <div class="panel-group" id="collapse">
                      <div class="panel panel-default" id="chat-panel">
                        <div class="panel-heading bg-darkblue-2">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" href="#chat-coll">
                              <i class="icon-briefcase-1"></i> Centro Salud
                              <span class="label bg-darkblue-1 pull-right">14</span>
                            </a>
                          </h4>
                        </div>
                        <div id="chat-coll" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <ul class="list-unstyled" id="chat-list">
                                <li><a href="javascript:;" class="online"><span class="chat-user-avatar"><img src="images/users/chat/1.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Descripcion</span></a></li>
                                <li><a href="javascript:;" class="online"><span class="chat-user-avatar"><img src="images/users/chat/2.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Descripcion</span></a></li>
                                <li><a href="javascript:;" class="online"><span class="chat-user-avatar"><img src="images/users/chat/3.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Descripcion</span></a></li>
                                <li><a href="javascript:;" class="away"><span class="chat-user-avatar"><img src="images/users/chat/4.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Descripcion</span></a></li>
                                <li><a href="javascript:;" class="offline"><span class="chat-user-avatar"><img src="images/users/chat/5.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg" title="I am flying to the moon and back">Descripcion</span></a></li>
                                <li><a href="javascript:;" class="offline"><span class="chat-user-avatar"><img src="images/users/chat/6.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Descripcion</span></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default" id="chat-panel">
                        <div class="panel-heading bg-green-3">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                              <i class="icon-heart-3"></i> Reportes
                              <span class="label bg-darkblue-1 pull-right">3</span>
                            </a>
                          </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <ul class="list-unstyled" id="chat-list">
                                <li><a href="javascript:;" class="online"><span class="chat-user-avatar"><img src="images/users/chat/1.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Titulo</span></a></li>
                                <li><a href="javascript:;" class="online"><span class="chat-user-avatar"><img src="images/users/chat/2.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Titulo</span></a></li>
                                <li><a href="javascript:;" class="online"><span class="chat-user-avatar"><img src="images/users/chat/3.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg"><i class="icon-play"></i>Descripcion</span></a></li>
                                <li><a href="javascript:;" class="away"><span class="chat-user-avatar"><img src="images/users/chat/4.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Titulo</span></a></li>
                                <li><a href="javascript:;" class="offline"><span class="chat-user-avatar"><img src="images/users/chat/5.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Descripcion</span></a></li>
                                <li><a href="javascript:;" class="offline"><span class="chat-user-avatar"><img src="images/users/chat/6.jpg"></span> <span class="chat-user-name">Titulo</span><span class="chat-user-msg">Titulo</span></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="settings">
                <div class="tab-inner slimscroller">
                    <div class="col-sm-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Right Sidebar End -->

    <div class="content-page">
        <?= $content ?>
    </div>

    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->
    <script> var resizefunc = []; </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core
            Core.init({
                sbm: "sb-l-c",
            });

            // Init Demo JS
            //Demo.init();
        });
    </script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
