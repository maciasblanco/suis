<?php

namespace app\controllers;

use Yii;
use app\modules\ev25\models\Certificado;
use app\modules\ev25\models\Madre;
use app\modules\ev25\models\Padre;
use app\modules\ev25\models\CertificadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use Mpdf;

class PdfController extends Controller
{

public function actionPdf($id)
    {
        require (yii::getAlias('@web') . '/mpdf/mpdf.php');
        $mpdf = new mPDF('utf-8', 'Legal');
        /*var_dump($id);
        die;*/

        $val = Yii::$app->db_ev25->CreateCommand("select * from ev25.certificado where id = $id")->queryOne();
        /*var_dump($val['id_establecimiento']);
        die;*/
        $centro = Yii::$app->db_ev25->CreateCommand("select * from ev25.certificado where id_establecimiento = ".$val['id_establecimiento'])->queryAll();
        //$centro = Certificado::findOne($val->id_establecimiento);
        //var_dump();die;
        $obj[]= [
                'datos_p'=>[
                'nombre_establecimiento' => $val['id_establecimiento']->idEstablecimiento->nombre,
                'num_historia' => $val->num_historia,
                'nombre_centro' => $val->idCentro->nombre,
                'codigo_estado' => $val->codigoEstado->estado,
                'codigo_municipio' => $val->codigoMunicipio->municipio,
                'codigo_parroquia' => $val->codigoParroquia->parroquia,
                'comunidad' => ($val->idComunidad!=null) ? $val->idPadre->nombre : null,
                


                'm_nombre1'=>$val->idMadre->nombre_1,
                'm_nombre2'=>$val->idMadre->nombre_2,
                'm_apellido1'=>$val->idMadre->apellido_1,
                'm_apellido2'=>$val->idMadre->apellido_2,
                'm_cedula' => $val->idMadre->cedula,
                'm_serial_carnet' => $val ->idMadre->serial_carnet,
                'm_codigo_estado' => $val->idMadre->codigoEstado->estado,
                'm_codigo_municipio' => $val->idMadre->codigoMunicipio->municipio,
                'm_codigo_parroquia' => $val->idMadre->codigoParoquia->parroquia,
                'm_comunidad' => $val->idMadre->idComunidad->nombre,
                'm_lugar_nacimiento' => $val->idMadre->lugar_nacimiento,
                'm_fecha_nac' => $val->idMadre->fecha_nac,
                'm_edad' => $val->idMadre->edad,
                'm_id_estado_civil' => $val->idMadre->idEstadoCivil->descripcion,
                'm_anos_casado' => $val->idMadre->anos_casado,
                'num_nacidos' => $val->idMadre->num_nacidos,
                'num_vivos' => $val->idMadre->num_vivos,
                'num_fallecido' => $val->idMadre->num_fallecido,
                'muerte_fetales' => $val->idMadre->muerte_fetales,
                'consulta' => $val->idMadre->consulta,
                'id_tipo_embarazo' => $val->idMadre->idTipoEmbarazo->tipo_embarazo,
                'id_tipo_parto' => $val->idMadre->idTipoParto->descripcion,
                'id_partero' => $val->idMadre->idPartero->descripcion,
                'm_id_nivel_educativo' => $val->idMadre->idNivelEducativo->descripcion,
                'm_id_ocupacion' => $val->idMadre->idOcupacion->nombre,
                'm_id_profesion' => $val->idMadre->idProfesion->nombre,
                'm_id_etnia' => $val->idMadre->idEtnia->descripcion,
                'm_idioma_indigena' => $val->idMadre->idioma_indigena,
                'm_id_tipo_documento' => $val->idMadre->id_tipo_documento,
                'm_id_nacionalidad' => $val->idMadre->id_nacionalidad,
                'm_etnia' => $val->idMadre->etnia,
                'num_consulta' => $val->idMadre->num_consulta,
                'm_codigo_estado_n' => ($val->idMadre->codigoEstadoN !=null)? $val->idMadre->codigoEstadoN->estado : $val->idMadre->idLugarNacimiento->nombre_esp,
                'm_edif_casa_qin' => $val->idMadre->edif_casa_qin,
                'm_piso' => $val->idMadre->piso,
                'm_apartamento' => $val->idMadre->apartamento,
                'm_urbanizacion' => $val->idMadre->urbanizacion,
                'm_avenida' => $val->idMadre->avenida,
                'm_cant_hijos' => $val->idMadre->cant_hijos,

                'p_nombre1' => ($val->idPadre !=null)? $val->idPadre->nombre_1 : null,
                'p_nombre2' => ($val->idPadre !=null)? $val->idPadre->nombre_2 : null,
                'p_apellido1' => ($val->idPadre !=null)? $val->idPadre->apellido_1 : null,
                'p_apellido2' => ($val->idPadre !=null)? $val->idPadre->apellido_2 : null,
                'p_cedula' => ($val->idPadre !=null)? $val->idPadre->cedula : null,
                'p_serial_carnet' => ($val->idPadre !=null)? $val->idPadre->serial_carnet : null,
                'p_codigo_estado' => ($val->idPadre !=null)? $val->idPadre->codigoEstado->estado : null,
                'p_codigo_municipio' => ($val->idPadre !=null)? $val->idPadre->codigoMunicipio->municipio :null,
                'p_codigo_parroquia' => ($val->idPadre !=null)? $val->idPadre->codigoParoquia->parroquia :null,
                'p_comunidad' => ($val->idPadre !=null)? $val->idPadre->idComunidad->nombre :null,
                'p_lugar_nacimiento' => ($val->idPadre !=null)? $val->idPadre->lugar_nacimiento : null,
                'p_fecha_nac' => ($val->idPadre !=null)? $val->idPadre->fecha_nac :null,
                'p_edad' => ($val->idPadre !=null)? $val->idPadre->edad : null,
                'p_id_estado_civil' => ($val->idPadre !=null)? $val->idPadre->idEstadoCivil->descripcion : null,
                'p_anos_casado' => ($val->idPadre !=null)? $val->idPadre->anos_casado : null,
                'p_id_nivel_educativo' => ($val->idPadre !=null)? $val->idPadre->idNivelEducativo->descripcion : null,
                'p_id_ocupacion' => ($val->idPadre !=null)? $val->idPadre->idOcupacion->nombre : null,
                'p_id_profesion' => ($val->idPadre !=null)? $val->idPadre->idProfesion->nombre : null,
                'p_id_etnia' => ($val->idPadre != null && $val->idPadre->idEtnia != null) ? $val->idPadre->idEtnia->descripcion : null,
                'p_idioma_indigena' => ($val->idPadre !=null)? $val->idPadre->idioma_indigena : null,
                'p_id_tipo_documento' => ($val->idPadre !=null)? $val->idPadre->id_tipo_documento : null,
                'p_id_nacionalidad' => ($val->idPadre !=null)? $val->idPadre->id_nacionalidad : null,
                'p_etnia' => ($val->idPadre !=null)? $val->idPadre->etnia : null,
                'p_id_pais_n' => ($val->idPadre !=null)? $val->idPadre->id_pais_n : null,
                'p_codigo_estado_n' => ($val->idPadre!=null)? $val->idPadre->codigo_estado_n : null,
                'p_edif_casa_qin' => ($val->idPadre !=null)? $val->idPadre->edif_casa_qin : null,
                'p_piso' => ($val->idPadre !=null)? $val->idPadre->piso : null,
                'p_apartamento' => ($val->idPadre !=null)? $val->idPadre->apartamento : null,
                'p_urbanizacion' => ($val->idPadre !=null)? $val->idPadre->urbanizacion : null,
                'p_avenida' => ($val->idPadre !=null)? $val->idPadre->avenida : null,
               
                'fecha' => $val->fecha,
                'hora' => $val->hora,
                'semana_gestacion' => $val->semana_gestacion,
                'talla' => $val->talla,
                'peso' => $val->peso,
                'id_sexo' => $val->idSexo->descripcion,
                'nombre_1' => $val->nombre_1,
                'apellido_1' => $val->apellido_1,
                'nombre_2' => $val->nombre_2,
                'apellido_2' => $val->apellido_2,
                'codigo_establecimiento' => $val->codigo_establecimiento,
                'id_malformacion_cong' => $val->idMalformacionCong->nombre_malf_cong,
                'perimetro_cefalico' => $val->perimetro_cefalico,
                'resp_cedula' => $val->resp_cedula,
                'resp_reg' => $val->resp_reg,
                'resp_nomb' => $val->resp_nomb,
                'urbanizacion' => $val->urbanizacion,
                'avenida' => $val->avenida,
                'codigo_establecimiento_nacimiento' => $val->codigo_establecimiento_nacimiento,
                'id_establecimiento_nacimiento' => $val->id_establecimiento_nacimiento,
                'own_nomb_est_nac' => $val->own_nomb_est_nac,
                'own_nomb_edo' => $val->own_nomb_edo,
                'own_nomb_muni' => $val->own_nomb_muni,
                'own_nomb_parro' => $val->own_nomb_parro,
                'own_nomb_est' => $val->own_nomb_est,
                'codigo_unico' => $val->codigo_unico
                ]
            ];

        $nombre = "a.pdf";

        //        return $this->render('recibo_pago_pdf2',['data'=>$obj]);

        $logo = '/img/certificado.jpg';
        $logo2 = '/img/logos/logo.jpg';
        $htmlh = "<div id=cont-header>
                <img src='". Yii::getAlias('@webroot').$logo ."'/>
            </div>";

        //$mpdf = new mPDF('utf-8', 'Legal');

        $css = Yii::getAlias('@webroot').'/css/estilos.css';
        $stylesheet = file_get_contents($css);
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->SetHTMLHeader($htmlh);
        //return $this->render('pdf',['data'=>$obj]);
        $mpdf->WriteHTML($this->renderPartial('pdf', ['data' => $obj]));
           
        $mpdf->Output(); //($nombre, 'D');
    }
 }