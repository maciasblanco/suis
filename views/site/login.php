<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<body class="fixed-left login-page">
    <div class="site-login">
        <!-- Begin page -->

        <div class="full-content-center">
            <div class="animated flipInX">

                        <img class="img_login" src="<?php echo Yii::$app->request->baseUrl; ?>/img/logos/logog.png"/>

                    <div class="login-wrap animated flipInX">
                    <div class="login-block">                                               
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <div class="form-group login-input">
                                <i class="fa fa-user overlay"></i>
                                <?= $form->field($model,'username')->textInput(['class'=>'form-control text-input','placeholder'=>'NOMBRE DE USUARIO'])->label(false) ?>
                            </div>

                            <div class="form-group login-input">
                                <i class="fa fa-key overlay"></i>
                                <?= $form->field($model,'password')->passwordInput(['class'=>'form-control text-input','placeholder'=>'********'])->label(false) ?>
                            </div>

                                
                            <div class="row">
                                <div class="text-center">
                                <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-success col-md-6 col-md-offset-3', 'name'=>'login-button']) ?>
                                </div>
                            </div>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>



</body>