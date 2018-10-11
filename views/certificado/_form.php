<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sexo;
use app\models\Estado;
use app\models\Centro;
use app\models\Establecimiento;
use app\models\EstadoCivil;
use app\models\MalformacionCong;
use app\models\TipoEmbarazo;
use app\models\TipoParto;
use app\models\TipoPartero;
use app\models\Ocupacion;
use app\models\Profesion;
use app\models\NivelEducativo;
use app\models\Etnia;
use app\models\DatosRepresentante;
use app\models\Paises;
/* @var $this yii\web\View */
/* @var $model app\models\Certificado */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui/jquery-ui.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/jquery-ui/jquery-ui.min.css');
$this->registerJsFile(Yii::getAlias('@web').'/js/chosen/chosen.jquery.min.js');
$this->registerCssFile(Yii::getAlias('@web').'/js/chosen/chosen.min.css');
?>

<div class="widget">

    <div class="widget-header transparent">
      <h2><strong>Certifición Electrónica de Nacimiento</strong></h2>
    </div>

    <div class="widget-content padding"> 
    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
           <div class="col-md-3">
                <?= $form->field($model, 'codigo_establecimiento')->textInput([
                  'onchange'=>'
                  var cod = $(this).val();

                  if (cod == "")
                    return false;

                  $.get("'.(Yii::$app->urlManager->createUrl(["certificado/precarga-establecimiento"])).'", 
                    {"cod": cod}, 
                    function(data) {
                      if (data != "") {
                        var datos = JSON.parse(data);
                        $("#certificado-id_establecimiento").val(datos.e).prop("readonly", true);
                        $("#certificado-own_nomb_est").val(datos.nombre).prop("readonly", true);

                        if (datos.n3 == null) {
                          $("#certificado-codigo_estado").val(datos.n1).prop("readonly", true);
                          $("#certificado-own_nomb_edo").val(datos.n1txt).prop("readonly", true);
                          $("#certificado-codigo_municipio").val("").prop("readonly", true);
                          $("#certificado-own_nomb_muni").val("").prop("readonly", true);
                          $("#certificado-codigo_paroquia").val("").prop("readonly", true);
                          $("#certificado-own_nomb_parro").val("").prop("readonly", true);
                        } elseif(datos.n3 == \'00\') {
                          $("#certificado-codigo_estado").val(datos.n2).prop("readonly", true);
                          $("#certificado-own_nomb_edo").val(datos.n2txt).prop("readonly", true);
                          $("#certificado-codigo_municipio").val(datos.n1).prop("readonly", true);
                          $("#certificado-own_nomb_muni").val(datos.n1txt).prop("readonly", true);
                          $("#certificado-codigo_paroquia").val("").prop("readonly", true);
                          $("#certificado-own_nomb_parro").val("").prop("readonly", true);
                        } else {
                          $("#certificado-codigo_estado").val(datos.n3).prop("readonly", true);
                          $("#certificado-own_nomb_edo").val(datos.n3txt).prop("readonly", true);
                          $("#certificado-codigo_municipio").val(datos.n2).prop("readonly", true);
                          $("#certificado-own_nomb_muni").val(datos.n2txt).prop("readonly", true);
                          $("#certificado-codigo_paroquia").val(datos.n1).prop("readonly", true);
                          $("#certificado-own_nomb_parro").val(datos.n1txt).prop("readonly", true);
                        }                       
                      } else {
                        
                    }
                  });
                ']) ?>
            </div>
            <div class="col-md-4">
            <?= $form->field($model, 'own_nomb_est')->textInput() ?>
            <?= $form->field($model, 'id_establecimiento')->hiddenInput()->label(false) ?>
            </div>
             <div class="col-md-2">
                <?= $form->field($model, 'num_historia')->textInput() ?>
            </div>
             <div class="col-md-3">
                <?php
                echo $form->field($model, 'id_centro')->dropDownList(
                ArrayHelper::map(Centro::find()->all(),'id','nombre'),[
                    'prompt'=>'Seleccione Centro',
                     'onchange'=>' 
                                var opc = $(this).val();
                                if (opc == 1 || opc == 2 || opc == 7 || opc == 8) {
                                        $("#establecimiento_nac").show();
                                        $("#nom_establecimiento_nac").show();
                                        } else {
                                        $("#establecimiento_nac").hide();
                                        $("#nom_establecimiento_nac").hide();
                                    }',
                    ]);
            ?>
            </div>
        </div>
            <div class="row">
            <div class="col-md-4" id="establecimiento_nac" style="display:none">
                <?= $form->field($model, 'codigo_establecimiento_nacimiento')->textInput(
                [
                  'onchange'=>'
                  var cod = $(this).val();

                  if (cod == "")
                    return false;

                  $.get("'.(Yii::$app->urlManager->createUrl(["certificado/precarga-establecimiento"])).'", 
                    {"cod": cod}, 
                    function(data) {
                      if (data != "") {
                        var datos = JSON.parse(data);
                        $("#certificado-id_establecimiento_nacimiento").val(datos.e).prop("readonly", true);
                        $("#certificado-own_nomb_est_nac").val(datos.nombre).prop("readonly", true);
                       
                      } else {
                        
                    }
                  });
                '
                ]) ?>
            </div>
            <div class="col-md-4" id="nom_establecimiento_nac" style="display:none">
                <?= $form->field($model, 'own_nomb_est_nac')->textInput() ?>
                <?= $form->field($model, 'id_establecimiento_nacimiento')->hiddenInput()->label(false) ?>
                 
           
            </div>
          
        </div>
            <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'avenida')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'urbanizacion')->textInput() ?>
            </div>
          
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'own_nomb_edo')->textInput() ?>
                <?= $form->field($model, 'codigo_estado')->hiddenInput()->label(false) ?>
            </div>
             <div class="col-md-4">
             <?= $form->field($model, 'own_nomb_muni')->textInput() ?>
             <?= $form->field($model, 'codigo_municipio')->hiddenInput()->label(false) ?>
             </div>
            <div class="col-md-4">
            <?= $form->field($model, 'own_nomb_parro')->textInput() ?>
            <?= $form->field($model, 'codigo_paroquia')->hiddenInput()->label(false) ?>
            </div>
        </div>
            <h1>Datos de la madre</h1>
                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($madre, 'id_tipo_documento')->dropDownList(ArrayHelper::map(\app\models\TipoDocumento::find()->all(), 'id', 'nombre'), [
              'prompt' => 'Seleccione',
              ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($madre, 'id_nacionalidad')->dropDownList(ArrayHelper::map(\app\models\Nacionalidad::find()->all(), 'id', 'letra'), [
              'prompt' => 'Seleccione',
              ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($madre, 'cedula')->textInput() ?>
                    </div>
                    <div class="col-md-3">    
                        <?= $form->field($madre, 'serial_carnet')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                      <?= $form->field($madre, 'apellido_1')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-md-3">
                      <?= $form->field($madre, 'apellido_2')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-md-3">
                    <?= $form->field($madre, 'nombre_1')->textInput(['maxlength' => true]) ?>
                  </div>
                  <div class="col-md-3">
                    <?= $form->field($madre, 'nombre_2')->textInput(['maxlength' => true]) ?>
                  </div>
                               
                </div> 
                 <div class="row">
                        <div class="col-md-2">
                        <?php
                            echo $form->field($madre, 'lugar_nacimiento')->dropDownList(
                            [1=>'Venezuela', 0=>'Exterior'],[
                                'prompt'=>'Seleccione ',
                                'onchange'=>' 
                                var opc = $(this).val();
                                if (opc == 1) {
                                        $("#madre_estado_n").show();
                                        $("#madre-codigo_estado_n").chosen("destroy").chosen(confChosen);
                                        $("#madre_pais_n").val("").hide();
                                        } else {
                                        $("#madre_pais_n").val("").show();
                                        $("#madre-id_pais_n").val("").chosen("destroy").chosen(confChosen);
                                        $("#madre_estado_n").hide();
                                    }',
                                ]);
                        ?>
                    </div>
                     <div class="col-md-2" id="madre_pais_n" style="display:none">
                        <?php
                            echo $form->field($madre, 'id_pais_n')->dropDownList(
                            ArrayHelper::map(Paises::find()->all(),'id','nombre_esp'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                     <div class="col-md-2" id="madre_estado_n" style="display:none">
                         <?php
                            echo $form->field($madre, 'codigo_estado_n')->dropDownList(
                            ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($madre, 'fecha_nac')->textInput() ?>
                    </div>
                    <div class="col-md-1"> 
                        <?= $form->field($madre, 'edad')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                         <?php
                            echo $form->field($madre, 'id_estado_civil')->dropDownList(
                            ArrayHelper::map(EstadoCivil::find()->all(),'id','descripcion'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($madre, 'anos_casado')->textInput() ?>
                    </div>
                </div>
                 <h3><strong>Dirección Domiciliaria</strong></h3>
                    <div class="row">
                      <div class="col-md-4">
                          <?= $form->field($madre, 'avenida')->textInput() ?>
                      </div>
                      <div class="col-md-4">
                          <?= $form->field($madre, 'edif_casa_qin')->textInput() ?>
                      </div>
                         <div class="col-md-1">
                          <?= $form->field($madre, 'piso')->textInput() ?>
                      </div>
                        <div class="col-md-2">
                          <?= $form->field($madre, 'apartamento')->textInput() ?>
                      </div>
                      </div>
                       <div class="row">
                      <div class="col-md-4">
                          <?= $form->field($madre, 'urbanizacion')->textInput() ?>
                      </div>
                  </div>
               <div class="row">
                    <div class="col-md-4">
                        <?php
                        //DropDownList para el estado
                        echo $form->field($madre, 'codigo_estado')->dropDownList(
                        ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),[
                            'prompt'=>'Seleccione Estado',
                            'onchange' => '
                            $.get("'.(Yii::$app->urlManager->createUrl(["municipio/get-por-edo"])).'", {"edo":$(this).val()},function(data) {
                              $("#madre-codigo_municipio").html(data).trigger("chosen:updated");
                            });']);
                    ?>
                    </div>
                     <div class="col-md-4">
                        <?php
                        //DropDownList para el Municipio
                        echo $form->field($madre, 'codigo_municipio')->dropDownList([],[
                        'prompt'=>'Seleccione Municipio',
                        'onchange' => '
                                $.get("'.(Yii::$app->urlManager->createUrl(["parroquia/get-por-muni"])).'", {"muni":$(this).val()},function(data) {
                                  $("#madre-codigo_paroquia").html(data).trigger("chosen:updated");
                                });']);
                             ?> 
                    </div>
                    <div class="col-md-4">
                        <?php
                        //DropDownList para el Municipio
                        echo $form->field($madre, 'codigo_paroquia')->dropDownList([],[
                        'prompt'=>'Seleccione Parroquia',
                        
                        ]); ?>
                    </div>
                </div>
                <h3><strong>Datos Socioeconómico</strong></h3>
                 <div class="row">
                    <div class="col-md-4">
                         <?php
                            echo $form->field($madre, 'id_nivel_educativo')->dropDownList(
                            ArrayHelper::map(NivelEducativo::find()->all(),'id','descripcion'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                         <?php
                            echo $form->field($madre, 'id_ocupacion')->dropDownList(
                            ArrayHelper::map(Ocupacion::find()->all(),'id','nombre'),[
                                'prompt'=>'Seleccione Ocupacion',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                         <?php
                            echo $form->field($madre, 'id_profesion')->dropDownList(
                            ArrayHelper::map(Profesion::find()->all(),'id','nombre'),[
                                'prompt'=>'Seleccione Profesion',
                                ]);
                        ?>
                    </div>
                </div>
                 <div class="row">
                        <div class="col-md-3">
                             <?php
                                echo $form->field($madre, 'etnia')->dropDownList(
                                [1=>'Si', 0=>'No'],[
                                    'prompt'=>'Seleccione ',
                                    'onchange'=>' 
                                    var opc = $(this).val();
                                    if (opc == 1) {
                                            $("#madre_etnia").show();
                                            $("#madre-id_etnia").chosen("destroy").chosen(confChosen);
                                            } else {
                                            $("#madre_etnia").hide();
                                            $("#madre-id_etnia")
                                        }',
                                    ]);
                            ?>
                        </div>
                        <div class="col-md-3" id="madre_etnia" style="display:none">
                            <?php
                                echo $form->field($madre, 'id_etnia')->dropDownList(
                                ArrayHelper::map(Etnia::find()->all(),'id','descripcion'),[
                                    'prompt'=>'Seleccione',
                                    ]);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                                echo $form->field($madre, 'idioma_indigena')->dropDownList(
                                [1=>'Si', 0=>'No'],[
                                    'prompt'=>'Seleccione ',
                                    ]);
                            ?>
                        </div>
                    </div>
                     <h3><strong>Datos Medicos</strong></h3>
                         <div class="row">
                            <div class="col-md-2">
                                <?= $form->field($madre, 'num_nacidos')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($madre, 'num_vivos')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($madre, 'num_fallecido')->textInput() ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($madre, 'muerte_fetales')->textInput() ?>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-3">   
                               <?php
                                echo $form->field($madre, 'consulta')->dropDownList(
                                [1=>'Si', 0=>'No'],[
                                    'prompt'=>'Seleccione ',
                                       'onchange'=>' 
                                var opc = $(this).val();
                                if (opc == 1)
                                        $("#madre-num_consulta").show();
                                    else {
                                        $("#madre-num_consulta").val("").hide();
                                    }',
                                    ]);
                                ?>
                            </div>
                            <div class="col-md-3" id="madre-num_consulta" style="display:none">
                               <?= $form->field($madre, 'num_consulta')->textInput() ?>
                            </div>  
                              


                              <div class="col-md-3">   
                               <?php
                                echo $form->field($madre, 'id_tipo_embarazo')->dropDownList(
                                ArrayHelper::map(TipoEmbarazo::find()->all(),'id','tipo_embarazo'),[
                                    'prompt'=>'Seleccione Embarazo',
                                       'onchange'=>' 
                                var opc = $(this).val();
                                console.log(opc);
                                 if (opc == 1) {
                                         $("#num_hijos").hide();
                                        $("#madre-cant_hijos").val("1").change();
                                    } elseif (opc == 2) {
                                        $("#num_hijos").hide();
                                        $("#madre-cant_hijos").val("2").change();
                                    }
                                    elseif (opc == 3) {
                                         $("#num_hijos").hide();
                                        $("#madre-cant_hijos").val("3").change();
                                    }
                                    elseif (opc == 4) {
                                         $("#num_hijos").hide();
                                        $("#madre-cant_hijos").val("4").change();
                                    }
                                  elseif (opc == 5)
                                        {$("#num_hijos").show();
                                         $("#madre-cant_hijos").val("").change();
                                       } else {
                                         $("#madre-cant_hijos").val("").change();
                                         $("#num_hijos").hide();
                                    }',
                                    ]);
                                ?>
                            </div>
                            
                             <div class="col-md-3" id="num_hijos" style="display:none">
                            <?= $form->field($madre, 'cant_hijos')->textInput(['onchange' => '
                              var  variable = $(this).val();
                              $.get("'.(yii::$app->urlManager->createUrl(['certificado/recien-nacido'])).'",{"numhijo":variable},function(datos) {
                                if (variable == 0) {
                                 $("#hijonac").html();
                                }
                                else
                                $("#hijonac").html(datos);
                              });
                            '])?>
                            </div>
                           



                            <div class="col-md-3">
                            <?php
                                echo $form->field($madre, 'id_tipo_parto')->dropDownList(
                                ArrayHelper::map(TipoParto::find()->all(),'id','descripcion'),[
                                    'prompt'=>'Seleccione Parto',
                                    ]);
                            ?>
                            </div>
                            <div class="col-md-3"> 
                            <?php
                                echo $form->field($madre, 'id_partero')->dropDownList(
                                ArrayHelper::map(TipoPartero::find()->all(),'id','descripcion'),[
                                    'prompt'=>'Seleccione Partero',
                                    ]);
                            ?>
                            </div>
                        </div> 
                        <h1>Datos del Padre</h1>
                               <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($padre, 'id_tipo_documento')->dropDownList(ArrayHelper::map(\app\models\TipoDocumento::find()->all(), 'id', 'nombre'), [
                          'prompt' => 'Seleccione',
                          ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($padre, 'id_nacionalidad')->dropDownList(ArrayHelper::map(\app\models\Nacionalidad::find()->all(), 'id', 'letra'), [
                          'prompt' => 'Seleccione',
                          ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($padre, 'cedula')->textInput() ?>
                    </div>
                    <div class="col-md-3">    
                        <?= $form->field($padre, 'serial_carnet')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                      <?= $form->field($padre, 'apellido_1')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                      <?= $form->field($padre, 'apellido_2')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                      <?= $form->field($padre, 'nombre_1')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                    <?= $form->field($padre, 'nombre_2')->textInput(['maxlength' => true]) ?>
                    </div>          
                </div> 
                  <div class="row">
                    <div class="col-md-2">
                        <?php
                            echo $form->field($padre, 'lugar_nacimiento')->dropDownList(
                            [1=>'Venezuela', 0=>'Exterior'],[
                                'prompt'=>'Seleccione ',
                                'onchange'=>' 
                                var opc = $(this).val();
                                if (opc == 1) {
                                        $("#padre_estado_n").show();
                                        $("#padre-codigo_estado_n").chosen("destroy").chosen(confChosen);
                                        $("#padre_pais_n").val("").hide();
                                        } else {
                                        $("#padre_pais_n").val("").show();
                                        $("#padre-id_pais_n").val("").chosen("destroy").chosen(confChosen);
                                        $("#padre_estado_n").hide();
                                    }',
                                ]);
                        ?>
                    </div>
                     <div class="col-md-2" id="padre_pais_n" style="display:none">
                        <?php
                            echo $form->field($padre, 'id_pais_n')->dropDownList(
                            ArrayHelper::map(Paises::find()->all(),'id','nombre_esp'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                     <div class="col-md-2" id="padre_estado_n" style="display:none">
                         <?php
                            echo $form->field($padre, 'codigo_estado_n')->dropDownList(
                            ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($padre, 'fecha_nac')->textInput() ?>
                    </div>
                    <div class="col-md-1"> 
                        <?= $form->field($padre, 'edad')->textInput() ?>
                    </div>
                    <div class="col-md-3">
                         <?php
                            echo $form->field($padre, 'id_estado_civil')->dropDownList(
                            ArrayHelper::map(EstadoCivil::find()->all(),'id','descripcion'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($padre, 'anos_casado')->textInput() ?>
                    </div>
                </div>
                        <h3><strong>Dirección Domiciliaria</strong></h3>
                    <div class="row">
                      <div class="col-md-4">
                          <?= $form->field($padre, 'avenida')->textInput() ?>
                      </div>
                      <div class="col-md-4">
                          <?= $form->field($padre, 'edif_casa_qin')->textInput() ?>
                      </div>
                         <div class="col-md-1">
                          <?= $form->field($padre, 'piso')->textInput() ?>
                      </div>
                        <div class="col-md-2">
                          <?= $form->field($padre, 'apartamento')->textInput() ?>
                      </div>
                      </div>
                       <div class="row">
                      <div class="col-md-4">
                          <?= $form->field($padre, 'urbanizacion')->textInput() ?>
                      </div>
                  </div>
               <div class="row">
                    <div class="col-md-4">
                        <?php
                        //DropDownList para el estado
                        echo $form->field($padre, 'codigo_estado')->dropDownList(
                        ArrayHelper::map(Estado::find()->all(),'codigo_estado','estado'),[
                            'prompt'=>'Seleccione Estado',
                            'onchange' => '
                            $.get("'.(Yii::$app->urlManager->createUrl(["municipio/get-por-edo"])).'", {"edo":$(this).val()},function(data) {
                              $("#padre-codigo_municipio").html(data).trigger("chosen:updated");
                            });']);
                    ?>
                    </div>
                     <div class="col-md-4">
                        <?php
                        //DropDownList para el Municipio
                        echo $form->field($padre, 'codigo_municipio')->dropDownList([],[
                        'prompt'=>'Seleccione Municipio',
                        'onchange' => '
                                $.get("'.(Yii::$app->urlManager->createUrl(["parroquia/get-por-muni"])).'", {"muni":$(this).val()},function(data) {
                                  $("#padre-codigo_paroquia").html(data).trigger("chosen:updated");
                                });']);
                             ?> 
                    </div>
                    <div class="col-md-4">
                        <?php
                        //DropDownList para el Municipio
                        echo $form->field($padre, 'codigo_paroquia')->dropDownList([],[
                        'prompt'=>'Seleccione Parroquia',
                        
                        ]); ?>
                    </div>
                </div>
              
                <h3><strong>Datos Socioeconómico</strong></h3>
                 <div class="row">
                    <div class="col-md-4">
                         <?php
                            echo $form->field($padre, 'id_nivel_educativo')->dropDownList(
                            ArrayHelper::map(NivelEducativo::find()->all(),'id','descripcion'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                         <?php
                            echo $form->field($padre, 'id_ocupacion')->dropDownList(
                            ArrayHelper::map(Ocupacion::find()->all(),'id','nombre'),[
                                'prompt'=>'Seleccione Ocupacion',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-4">
                         <?php
                            echo $form->field($padre, 'id_profesion')->dropDownList(
                            ArrayHelper::map(Profesion::find()->all(),'id','nombre'),[
                                'prompt'=>'Seleccione Profesion',
                                ]);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                         <?php
                            echo $form->field($padre, 'etnia')->dropDownList(
                            [1=>'Si', 0=>'No'],[
                                'prompt'=>'Seleccione ',
                                'onchange'=>' 
                                var opc = $(this).val();
                                if (opc == 1) {
                                        $("#padre_etnia").show();
                                        $("#padre-id_etnia").chosen("destroy").chosen(confChosen);
                                        } else {
                                        $("#padre_etnia").hide();
                                        $("#padre-id_etnia")
                                    }',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-3" id="padre_etnia" style="display:none">
                        <?php
                            echo $form->field($padre, 'id_etnia')->dropDownList(
                            ArrayHelper::map(Etnia::find()->all(),'id','descripcion'),[
                                'prompt'=>'Seleccione',
                                ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                            echo $form->field($padre, 'idioma_indigena')->dropDownList(
                            [1=>'Si', 0=>'No'],[
                                'prompt'=>'Seleccione ',
                                ]);
                        ?>
                    </div>
                </div>
                        <h1>Datos del Recien Nacido</h1>
                           <div id="hijonac"></div>
                                    <h1>Responsable del Certificado</h1>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?= $form->field($model, 'resp_cedula')->textInput() ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= $form->field($model, 'resp_reg')->textInput() ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= $form->field($model, 'resp_nomb')->textInput(['maxlength' => true]) ?>
                                        </div>
                                    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Certificado' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   </div>

</div>
<?php
$this->registerJs('
  //Para activar el chosen
  

  $( "#certificado-fecha, #madre-fecha_nac,\
      #padre-fecha_nac").datepicker({
    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
    monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
    changeYear: true,
    changeMonth: true,
    dateFormat: "dd-mm-yy",
  });
  '); 
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

