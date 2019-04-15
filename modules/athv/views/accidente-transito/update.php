<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\athv\models\AccidenteTransito */

$this->title = 'Modificar Accidente de Transito N° ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accidente Transitos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content">

	<div class="row">
        <div class="col-sm-12 portlets">
         <div class="widget">
            <div class="widget-content padding"> 
				<?= $this->render('_form', [
        			'model' => $model,
        			'modelperso' => $modelperso,
    			]) ?>
			</div>
         </div>
        </div>
    </div>
    
</div>
