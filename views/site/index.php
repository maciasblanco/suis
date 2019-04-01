<?php

/* @var $this yii\web\View */

$this->title = 'Sistema Único de Información en Salud';
?>
<div id="widget_scroll_container">
    <div class="widget_container full" data-num="0">
        <div class="widget widget4x2 widget_white" data-theme="white" data-name="morbilidad">
            <a href="<?= Yii::$app->urlManager->createUrl(['/epi10/epi10'])?>"  style="color: white;">      
                <div class="widget_content">
                    <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/morbilidad_logo.png'); background-size: 120%;">
                        <span>MORBILIDAD</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="widget widget4x2 widget_red" data-theme="red" data-name="inmunizaciones">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/inmunizaciones.png'); background-size: contain;">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="widget widget2x2 widget_darkblue" data-theme="darkblue" data-name="oncologia">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/oncologia0.png'); background-size: contain;">
                    <span>ONCOLOGIA</span>
                </div>
            </div>
        </div>
        <div class="widget widget2x2 widget_red"  data-theme="red" data-name="fichas">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/images/widget_dialog.png');">
                    <span>FICHAS EPIDEMIOLÓGICAS</span>
                </div>
            </div>
        </div>
        <div class="widget widget4x2 widget_red" data-theme="red" data-name="mortalidad">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/mortalidad_logo.png'); background-size: 130%; margin-top: -25px;">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="widget widget2x2 widget_darkblue" data-theme="darkblue" data-name="cirugia">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/scalpel.png'); background-size: 80%;">
                    <span>CIRUGÍA</span>
                </div>
            </div>
        </div>

        <div class="widget widget2x2 widget_white" data-theme="white" data-name="malaria">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/malaria1.png'); background-size: 300%;">
                    <span>MALARIA</span>
                </div>
            </div>
        </div>

        <div class="widget widget2x2 widget_red" data-theme="red" data-name="sigemed">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/sigemed.png'); background-size: 80%;">
                    <span>SIGEMED</span>
                </div>
            </div>
        </div>

        <div class="widget widget2x2 widget_darkblue" data-theme="darkblue" data-name="censo">
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/images/widget_file.png');">
                    <span>CENSO DE MÉDICOS</span>
                </div>
            </div>
        </div>
        <div class="widget widget2x2 widget_white" data-name="ev25">
            <a href="<?= Yii::$app->urlManager->createUrl(['/ev25/certificado/index'])?>"  style="color: white;">
                <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/ev25.png'); background-size: contain;">
                        <span>CERTIFICADO EV-25</span>
                    </div>
                </div>
        </a>
        </div>
        <div class="widget widget2x2 widget_darkblue" data-theme="darkblue" data-name="sicasmi">
        <a href="<?= Yii::$app->urlManager->createUrl(['/sicasmi/embarazadas/inicio'])?>"  style="color: white;">   
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/sicasmi3.png'); background-size: contain;">
                <span>SICASMI</span>
            </div>
            </div>
        </a>
        </div>
        <div class="widget widget4x2 widget_red" data-theme="red" data-name="accidentes">
        <a href="<?= Yii::$app->urlManager->createUrl(['/athv/'])?>"  style="color: white;">    
            <div class="widget_content">
                <div class="main" style="background-image:url('<?= Yii::getAlias('@web') ?>/img/accidentes.png');">
                    <span></span>
            </div>
            </div>
        </a>
        </div>
        <div class="widget widget2x2 widget_grey" data-url="" data-theme="grey" data-name="">
            <div class="widget_content">
                <div class="main">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="widget widget1x1 widget_grey" data-url="" data-theme="grey" data-name="">
            <div class="widget_content">
                <div class="main">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="widget widget1x1 widget_grey" data-url="" data-theme="grey" data-name="">
            <div class="widget_content">
                <div class="main">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="widget widget1x1 widget_grey" data-url="" data-theme="grey" data-name="">
            <div class="widget_content">
                <div class="main">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="widget widget1x1 widget_grey" data-url="" data-theme="grey" data-name="">
            <div class="widget_content">
                <div class="main">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</div>
