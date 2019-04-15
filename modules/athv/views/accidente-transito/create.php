<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\AccidenteTransito */

$this->title = 'Registrar Accidente de Transito';
$this->params['breadcrumbs'][] = ['label' => 'Accidente Transitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content"><!---Cambie-->
    
				<?= $this->render('_form', [
        			'model' => $model,
        			'modelperso' => $modelperso,
   				 ]) ?>
           
       
   

    

</div>
