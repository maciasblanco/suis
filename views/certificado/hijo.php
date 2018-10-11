<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sexo;
use app\models\MalformacionCong;

/* @var $this yii\web\View */
/* @var $model app\models\Certificado */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui/jquery-ui.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/jquery-ui/jquery-ui.min.css');
$this->registerJsFile(Yii::getAlias('@web').'/js/chosen/chosen.jquery.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/chosen/chosen.min.css');
?>
<?php for ($i=1; $i <= $numhijo ; $i++) {  ?> 
<h3>Hijo Número <?php echo $i?></h3>
                            <div class="row">
                                <div class="col-md-3">
                                <div class="form-group ">
                                    <?= Html::activeLabel($reciennacido, 'apellido_1', ['class' => 'control-label']) ?>
                                    <?= Html::activeInput('text', $reciennacido, 'apellido_1', ['maxlength' => true,
                                      'id'=>'recien-'.$i.'apellido_1',
                                      'class'=>'form-control',
                                          'name'=>'RecienNacido['.$i.'][apellido_1]',]) ?>
                                    <?= Html::error($reciennacido, 'apellido_1', ['class' => 'help-block']) ?>
                                 </div>
                                 </div>
                                <div class="col-md-3">
                                  <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'apellido_2', ['class' => 'control-label']) ?>
                                    <?= Html::activeInput('text', $reciennacido, 'apellido_2', ['maxlength' => true,
                                      'id'=>'recien-'.$i.'apellido_2',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][apellido_2]',]) ?>
                                    <?= Html::error($reciennacido, 'apellido_2', ['class' => 'help-block']) ?>
                                 </div>
                                </div>
                                  <div class="col-md-3">
                                  <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'nombre_1', ['class' => 'control-label']) ?>
                                    <?= Html::activeInput('text', $reciennacido, 'nombre_1', ['maxlength' => true,
                                      'id'=>'recien-'.$i.'nombre_1',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][nombre_1]',]) ?>
                                     <?= Html::error($reciennacido, 'nombre_1', ['class' => 'help-block']) ?>
                                 </div>
                                 </div>
                                <div class="col-md-3">
                                 <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'nombre_2', ['class' => 'control-label']) ?>
                                      <?= Html::activeInput('text', $reciennacido, 'nombre_2', ['maxlength' => true,
                                      'id'=>'recien-'.$i.'nombre_2',
                                      'class'=>'form-control',
                                      'name'=>'RecienNacido['.$i.'][nombre_2]',]) ?>
                                      <?= Html::error($reciennacido, 'nombre_2', ['class' => 'help-block']) ?>
                                 </div>                                 
                                </div>
                             </div>     
                            <div class="row">
                             <div class="col-md-3">
                              <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'fecha', ['class' => 'control-label']) ?>
                                    <?= Html::activeInput('text', $reciennacido, 'fecha', [
                                      'id'=>'recien-'.$i.'fecha',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][fecha]',]) ?>
                                      <?= Html::error($reciennacido, 'fecha', ['class' => 'help-block']) ?>
                                 </div> 
                                </div>
                                <div class="col-md-2"> 
                                  <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'hora', ['class' => 'control-label']) ?>  
                                    <?= Html::activeInput('text',$reciennacido, 'hora', [
                                      'id'=>'recien-'.$i.'hora',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][hora]',]) ?>
                                        <?= Html::error($reciennacido, 'hora', ['class' => 'help-block']) ?>
                                 </div> 
                                </div>
                                  <div class="col-md-2">
                                  <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'id_sexo', ['class' => 'control-label']) ?> 
                                     <?= Html::activeDropDownList($reciennacido, 'id_sexo',ArrayHelper::map(Sexo::find()->all(),'id','descripcion'),[
                                        'prompt'=>'Seleccione Sexo',
                                        'id'=>'recien-'.$i.'id_sexo',
                                        'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][id_sexo]',
                                        ]); ?>
                                       <?= Html::error($reciennacido, 'id_sexo', ['class' => 'help-block']) ?>
                                 </div> 
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'semana_gestacion', ['class' => 'control-label']) ?> 
                                    <?= Html::activeInput('text',$reciennacido, 'semana_gestacion',[
                                      'id'=>'recien-'.$i.'semana_gestacion',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][semana_gestacion]',]) ?>
                                      <?= Html::error($reciennacido, 'semana_gestacion', ['class' => 'help-block']) ?>
                                 </div>
                                </div>
                                <div class="col-md-1">
                                <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'peso', ['class' => 'control-label']) ?>
                                    <?= Html::activeInput('text',$reciennacido, 'peso', [
                                      'id'=>'recien-'.$i.'peso',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][peso]',]) ?>
                                     <?= Html::error($reciennacido, 'peso', ['class' => 'help-block']) ?>
                                 </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'talla', ['class' => 'control-label']) ?>
                                       <?= Html::activeInput('text',$reciennacido, 'talla', [
                                      'id'=>'recien-'.$i.'talla',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][talla]',]) ?>
                                         <?= Html::error($reciennacido, 'talla', ['class' => 'help-block']) ?>
                                 </div>
                                </div>
                                <div class="col-md-3">
                                 <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'id_malformacion_cong', ['class' => 'control-label']) ?>
                                     <?php
                                        echo Html::activeDropDownList($reciennacido, 'id_malformacion_cong', ArrayHelper::map(MalformacionCong::find()->all(),'id','nombre_malf_cong'),[
                                            'prompt'=>'Seleccione',
                                            'id'=>'recien-'.$i.'id_malformacion_cong',
                                            'class'=>'form-control',
                                          'name'=>'RecienNacido['.$i.'][id_malformacion_cong]',
                                            ]);?>
                                           <?= Html::error($reciennacido, 'id_malformacion_cong', ['class' => 'help-block']) ?>
                                 </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group ">
                                   <?= Html::activeLabel($reciennacido, 'perimetro_cefalico', ['class' => 'control-label']) ?>
                                    <?= Html::activeInput('text',$reciennacido, 'perimetro_cefalico',[
                                      'id'=>'recien-'.$i.'perimetro_cefalico',
                                      'class'=>'form-control',
                                        'name'=>'RecienNacido['.$i.'][perimetro_cefalico]',]) ?>
                                          <?= Html::error($reciennacido, 'perimetro_cefalico', ['class' => 'help-block']) ?>
                                 </div>
                                </div>
                            </div>

<?php
$this->registerJs('
  //Para activar el chosen
  

  $( "#recien-'.$i.'fecha").datepicker({
    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
    monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
    changeYear: true,
    changeMonth: true,
    dateFormat: "dd-mm-yy",
  });
  '); 
}


?>
<?php
$this->registerJs('
    confChosen = {
        allow_single_deselect: true,
        no_results_text: "No se han encontrado resultados",
        placeholder_text_multiple: "Selecciona una o más opciones",
        placeholder_text_single: "Seleccione una opcion",
        max_shown_results: 200,
    };

    //Para activar el chosen
    $("select").chosen(confChosen);
    
    ');

$this->registerJs('
    $("form").submit(function() {
      var perimetro = $("#certificado-perimetro_cefalico").val();
      
      if(perimetro < 1) {
        alert("El perimetro cefalico esta por debajo del limite");
      }
      elseif (perimetro > 500) {
          alert("El perimetro cefalico esta por encima del limite");
        }



    })
    
    ');

$this->registerJs('
    $("form").submit(function() {
      var semana = $("#certificado-semana_gestacion").val();
      var peso = $("#certificado-peso").val();

      if(semana == 22 && (peso < 390)) {
        alert("El peso esta por debajo del limite");
      }
      elseif(semana == 22 && (peso > 780)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 23 && (peso < 450) ) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 23 && (peso > 800)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 24 && (peso < 500)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 24 && (peso > 900) ) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 25 && (peso < 500)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 25 && (peso > 1040)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 26 && (peso < 520)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 26 && (peso > 1100)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 27 && (peso < 573) ) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 27 && (peso > 1340)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 28 && (peso < 633) ) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 28 && (peso > 1521)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 29 && (peso < 703)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 29 && (peso > 1750)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 30 && (peso < 793)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 30 && (peso > 1950)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 31 && (peso < 890)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 31 && (peso > 2200)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 32 && (peso < 1020)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 32 && (peso > 2300) ) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 33 && (peso < 1195)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 33 && (peso > 2550) ) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 34 && (peso < 1400)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 34 && (peso > 2780)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 35 && (peso < 1600)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 35 && (peso > 3100)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 36 && (peso < 1800)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 36 && (peso > 3240)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 37 && (peso < 2000) ) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 37 && (peso > 3490)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 38 && (peso < 2290)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 38 && (peso > 3690)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 39 && (peso < 2400)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 39 && (peso > 3870)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 40 && (peso < 2500)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 40 && (peso > 4020)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 41 && (peso < 2600)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 41 && (peso > 4100)) {
          alert("El peso esta por encima del limite");
        }
      elseif(semana == 42 && (peso < 2600)) {
          alert("El peso esta por debajo del limite");
        }
      elseif(semana == 42 && (peso > 4230)) {
          alert("El peso esta por encima del limite");
        }
    })
    
    ');

$this->registerJs('
    $("form").submit(function() {
      var semana = $("#certificado-semana_gestacion").val();
      var talla = $("#certificado-talla").val();

      if(semana == 22 && (talla < 23)) {
        alert("El talla esta por debajo del limite");
      }
      elseif(semana == 22 && (talla > 32)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 23 && (talla < 24)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 23 && (talla > 34)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 24 && (talla < 25)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 24 && (talla > 35)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 25 && (talla < 26)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 25 && (talla > 37)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 26 && (talla < 27)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 26 && (talla > 38)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 27 && (talla < 28)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 27 && (talla > 39)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 28 && (talla < 29)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 28 && (talla > 41)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 29 && (talla < 30)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 29 && (talla > 42)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 30 && (talla < 32)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 30 && (talla > 43)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 31 && (talla < 33)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 31 && (talla > 44)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 32 && (talla < 35)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 32 && (talla > 45)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 33 && (talla < 36)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 33 && (talla > 46)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 34 && (talla < 38)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 34 && (talla > 47)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 35 && (talla < 40)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 35 && (talla > 48)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 36 && (talla < 41)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 36 && (talla > 49)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 37 && (talla < 43)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 37 && (talla > 50)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 38 && (talla < 44)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 38 && (talla > 51)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 39 && (talla < 45)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 39 && (talla > 51)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 40 && (talla < 46)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 40 && (talla > 52)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 41 && (talla < 46)) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 41 && (talla > 52)) {
          alert("El talla esta por encima del limite");
        }
      elseif(semana == 42 && (talla < 46) ) {
          alert("El talla esta por debajo del limite");
        }
      elseif(semana == 42 && (talla > 53) ) {
          alert("El talla esta por encima )del limite");
        }
    })

    
    
    ');
?>

