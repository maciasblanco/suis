<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\HechoViolento */

$this->title = 'Registrar Hecho Violento';
$this->params['breadcrumbs'][] = ['label' => 'Hecho Violentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">

	
				  <?= $this->render('_form', [
       				'model' => $model,
       				'modelperso' => $modelperso,
    			   ]) ?>
    		
  

</div>
