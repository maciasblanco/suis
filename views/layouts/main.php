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
};

$opcMenu = array_merge(MenuHelper::getAssignedMenu(Yii::$app->user->id, NULL, $menuCallback), [
            [
              'label' => Yii::$app->user->isGuest ? 'Iniciar Sesión' : 'Cerrar Sesión',
              'url' => Yii::$app->user->isGuest ? ['/site/login'] : ['/site/logout']]
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
        <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/img/logos/logo_mpps.png"> 
    <?php $this->head() ?>
</head>

<body class="sb-l-o sb-r-c fixed-left">
<?php $this->beginBody() ?>

<div id="wrapper">
    <!-- Top Bar Start -->
    <header class="navbar navbar-fixed-top">
        <div class="topbar">
            <div class="topbar-left">
                <div class="logo">
                    <h1><?php echo Html::a
                        ('<img src="'.Yii::$app->request->baseUrl.'/img/logos/logo.png" alt="Logo">', 
                        ['/site/index']); 
                    ?></h1>
                </div>
                <button id="but" class="button-menu-mobile open-left">
                <i class="glyphicon glyphicon-menu-hamburger"></i></button>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-collapse2">                   
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
        <div id="izquierda" class="left side-menu">
            <div class="sidebar-inner">
            <div id="sidebar-menu">
            <ul>
              <?php foreach ($opcMenu as $opc): ?>
                <li class="has_sub">
                    <a href="<?= $opc['url'][0] != NULL ? Yii::$app->urlManager->createUrl($opc['url'][0]) : '#' ?>">
                      <?= $opc['label'] ?>
                      <?php if (!empty($opc['items'])): ?>
                        <ul style="display: none">
                          <?php foreach ($opc['items'] as $subopc): ?>
                            <li>
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
            </ul>
            </div>
            </div>
        </div>
    <!-- Left Sidebar End -->    

    <section id="content_wrapper">
    	<div class="content-page">
        	<div class="content">
	   		<?= $content ?>
        	</div>
    	</div>   
    </section>     

    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script type="text/javascript">

        $(document).ready(function(){
        $('#but').click(function(){
            var cerrado=$('#izquierda').hasClass('colapsado');
            if (cerrado) {
                 $('#izquierda').addClass('expandido').removeClass('colapsado');
                 $("#content_wrapper").css("margin-left", "239px");
                 $('#sidebar-menu').show();
                /*alert('sfdsf');*/
                 //$("#elcont").html("");
                 //$("#mostrar").hide();
                 //$("#logo").show();
            } else {
                /*alert('mostrado');*/
                $('#izquierda').addClass('colapsado').removeClass('expandido');
                $("#content_wrapper").css("margin-left", "49px");
                $('#sidebar-menu').hide();
                //$("#elcont").html("");
                /*alert('debe mostrar este texto');*/
                //$("#logo").hide();
                //$("#mostrar").show();
            }

        });
	
        $(".has_sub").click(function(e){
            var self = $(this);
	
	    $(".has_sub").each(function(){
		$(this).children("a").removeClass("active");
		$(this).children("ul").hide();
	    });

	    self.children("a").addClass('active');	
            self.find("ul").show();
            self.find("ul a").each(function(){
                if ($(this).hasClass("mostrar")){
                    $(this).show();
                }
                else{
                    $(this).hide();
                }
            });
        });
    });
    </script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
