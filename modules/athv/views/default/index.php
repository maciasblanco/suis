<!--<div class="athv-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>-->
<?php
$script = '
  function actEstad(id, valor){
    $("#"+id).attr("data-value", valor);
    $("#"+id).animateNumbers($("#"+id).attr("data-value"), true, parseInt($("#"+id).attr("data-duration")));
  }
  ';

$this->registerJs($script, $this::POS_HEAD);
?>

    <div class="content">
        <!-- Start info box -->
            <div class="row top-summary">
                <div class="col-lg-3 col-md-6">
                    <div class="widget darkblue-2 animated fadeInDown">
                        <div class="widget-content padding">
                            <div class="widget-icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <div class="text-box">
                                <p class="maindata"><b>POR DEFINIR</b></p>
                                <h2><span id="per-valor" class="animate-number" data-value="0" data-duration="3000">0</span></h2>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="widget-footer">
                            <div class="row">
                                <div class="col-sm-12 tile-stats">
                                    <i id="per_total" title="Total" class="fa fa-inbox enlinea"></i>
                                    <i id="per_hoy" title="Hoy" class="fa fa-clock-o enlinea"></i>
                                    <i id="per_semana" title="Última Semana" class="fa fa-calendar enlinea"></i>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="widget kavach animated fadeInDown">
                        <div class="widget-content padding">
                            <div class="widget-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="text-box">
                                <p class="maindata"><b>POR DEFINIR</b></p>
                                <h2><span id="soli-valor" class="animate-number" data-value="0" data-duration="3000">0</span></h2>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="widget-footer">
                            <div class="row">
                                <div class="col-sm-12 tile-stats">
                                    <i id="soli_total" title="Total" class="fa fa-inbox enlinea"></i>
                                    <i id="soli_hoy" title="Hoy" class="fa fa-clock-o enlinea"></i>
                                    <i id="soli_semana" title="Última Semana" class="fa fa-calendar enlinea"></i>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="widget darkblue-2 animated fadeInDown">
                        <div class="widget-content padding">
                            <div class="widget-icon">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="text-box">
                                <p class="maindata"><b>ESTADO CON MAS ACCIDENTES</b></p>
                                <h2><span id="edo-valor" class="animate-number" data-value="70389" data-duration="3000">0</span></h2>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="widget-footer">
                            <div class="row">
                                <div id="edo-nombre" class="col-sm-12">
                                    DISTRITO CAPITAL
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="widget kavach animated fadeInDown">
                        <div class="widget-content padding">
                            <div class="widget-icon">
                                <i class="fa fa-institution"></i>
                            </div>
                            <div class="text-box">
                                <p class="maindata"><b>ESTADO CON MAS HECHOS VIOLENTOS</b></p>
                                <h2><span class="animate-number" data-value="18648" data-duration="3000">0</span></h2>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="widget-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    MATERNIDAD CONCEPCION PALACIOS
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
           </div>
         </div>
           <div class="row">
               <div class="col-lg-6 portlets" id="texto" style="padding-left: 35px; padding-right: 20px;">
                 <div id="website-statistics1" class="widget">
                     <div class="widget-header transparent">
                         <h2><i class="icon-chart-line"></i> <strong>Accidentes de Tránsito y Hechos Violentos</strong> ¿Qué es?</h2>
                    </div>
                    <div class="widget-content">
                        <div id="website-statistic" class="statistic-chart" style="margin-left: 5px;margin-right: 5px;">
                            Se trata del documento oficial que emite el Ministerio del Poder Popular Para la Salud
                            que  se inicia con el registro de Nacimiento un ser vivo ocurrido el territorio de la república,
                             a fín de dejar constancia del hecho para dar a conocer su identidad. 
                        </div>
                    </div>
                  </div>

                   <div id="website-statistics1" class="widget">
                    <div class="widget-header transparent">
                      <h2><i class="icon-chart-line"></i><strong>Descarga del Manual de usuario</strong></h2>
                    </div>
                    <div class="widget-content">
                      <p style="margin-left: 10px;">
                        Aquí se Colocará el Manual de Usuario del Modulo de Accidente de Tránsito y Hechos Violentos
                      </p>
                      <button type="button" class="btn btn-danger" style="margin-left: 5px;">Descarga</button>
                    </div>
                    </div>

                </div>
                <div class="col-lg-6 portlets" style="padding-right: 35px;">
                    <div id="website-statistics1" class="widget">
                        <div class="widget-header transparent">
                            <h2><i class="icon-chart-line"></i> <strong>Solicitudes</strong> Por definir</h2>
                            <div class="additional-btn">
                                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                                  <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                                    <i class="fa fa-cogs"></i>
                                  </a>
                                  <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">Establecimientos de Salud</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                  </ul>
                                 <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                                <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div id="website-statistic" class="statistic-chart">
                                <div class="row stacked">
                                    <div class="col-sm-12">
                                       <div class="clearfix"></div>
                                       <div id="paper-middle">
                                            <div id="map" style="width:100%; height:100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

                   <div class="col-lg-6 portlets">
                       <div id="website-statistics1" class="widget">
                           <div class="widget-header transparent">
                               <h2><i class="icon-chart-line"></i> <strong>Gráficos</strong> Aqui van algunas estadisticas</h2>
                               <div class="additional-btn">
                                   <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                                     <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                       <li><a href="#">Establecimientos de Salud</a></li>
                                       <li><a href="#">Another action</a></li>
                                       <li><a href="#">Something else here</a></li>
                                       <li class="divider"></li>
                                       <li><a href="#">Separated link</a></li>
                                     </ul>
                                    <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                                   <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                                   <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                               </div>
                           </div>
                           <div class="widget-content">
                               <div id="website-statistic" class="statistic-chart">
                                   <div class="row stacked">
                                       <div class="col-sm-12">
                                          <div class="clearfix"></div>
                                          <div id="paper-middle">
                                               <div id="map" style="width:100%; height:100%;"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>
                   <div class="col-lg-6 portlets">
                       <div id="website-statistics1" class="widget">
                           <div class="widget-header transparent">
                               <h2><i class="icon-chart-line"></i> <strong>Gráficos</strong> Aqui van algunas estadisticas</h2>
                               <div class="additional-btn">
                                   <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                                     <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                                       <li><a href="#">Establecimientos de Salud</a></li>
                                       <li><a href="#">Another action</a></li>
                                       <li><a href="#">Something else here</a></li>
                                       <li class="divider"></li>
                                       <li><a href="#">Separated link</a></li>
                                     </ul>
                                    <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                                   <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                                   <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                               </div>
                           </div>
                           <div class="widget-content">
                               <div id="website-statistic" class="statistic-chart">
                                   <div class="row stacked">
                                       <div class="col-sm-12">
                                          <div class="clearfix"></div>
                                          <div id="paper-middle">
                                               <div id="map" style="width:100%; height:100%;"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>
               </div>
    </div>

    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl; ?>/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>

     <script>
        function myMap() {
        var map= {
            center:new google.maps.LatLng(8.52980,-66.22829),
            zoom:6,
        };
        var map=new google.maps.Map(document.getElementById("map"),map);
        }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxH0fa2cuNeYHwXzlSqkI1s6yEq8sCmAo&callback=myMap"></script>
<script type="text/javascript">
  $(document).on('click', '.per-actualizar', function(){
    var id = 'per-valor';
    var r = $(this).data('rango');

    $(id).html('Contando...');

    $.get("<?=Yii::$app->urlManager->createUrl('solicitante/get-cant')?>", {
      'r':r,
    }, function(data){
      actEstad(id, data);
    });
  });

  $(document).on('click', '.soli-actualizar', function(){
    var id = 'soli-valor';
    var r = $(this).data('rango');

    $(id).html('Contando...');

    $.get("<?=Yii::$app->urlManager->createUrl('solicitud/get-cant')?>", {
      'r':r,
    }, function(data){
      actEstad(id, data);
    });
  });

  $(document).ready(function(){
    $(".per-actualizar[data-rango='todo']").click();
    $(".soli-actualizar[data-rango='todo']").click();
  });
</script>

