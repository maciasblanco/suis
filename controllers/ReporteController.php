<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\components\DynamicReportComponent;
use app\models\ReporteFiltro;
use app\models\ReporteDinamicoFiltro;
use app\models\DynamicReportFilter;
use common\models\Usuario;

class ReporteController extends \yii\web\Controller{
	/**
   * @inheritdoc
   */
  public function behaviors()
  {
      return [
          'access' => [
            'class' => AccessControl::className(),
            'rules' => [
              [
                'allow' => true,
                'roles' => ['@'],
              ],
            ],
          ],
      ];
  }

  /**
   * @param $data Array debe tener como primera fila el listado de titulos
   * @param $file String el nombre dle archivo a escribir
   * @param $title String el titulo que llevara el archivo al descargarlo
   * Envia un archivo csv
   */
  public function sendCsv($data, $file, $title) {
    $f = fopen($file, 'w');

    if (!empty($data)){
      //Se escribe la cabecera del archivo
      $titulo = [];

      foreach ($data[0] as $col=>$val){
        $titulo[] = mb_strtoupper($col, 'UTF-8');
      }

      fwrite($f, implode(';', $titulo).PHP_EOL);

      foreach($data as $row){
        //$row['direccion'] = '"'.($row['direccion']).'"';
        fwrite($f, mb_strtoupper(trim(str_replace(["\r","\n"], " ", implode(';', $row))), 'UTF-8').PHP_EOL);
      }
      
    }

    fclose($f);

    ignore_user_abort();
    
    Yii::$app->response->sendFile($file, "{$title}.csv");
    unlink($file);
  }

  /**
   * Reporte dinamico con filtros
   */
  public function actionDinamico()
  {
    $filtro = new DynamicReportFilter([
        ['column' => 'dp.cedula', 'label' => 'Cedula paciente', 'type' => DynamicReportComponent::TYPE_NUMBER],
        ['column' => 'dp.nombre', 'label' => 'Nombre paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'dp.apellido', 'label' => 'Apellido paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'dp.telefono_1', 'label' => 'Telefono paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'dp.telefono_2', 'label' => 'Telefono 2 paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'dp.fecha_nacimiento', 'label' => 'Fecha nacimiento paciente', 'type' => DynamicReportComponent::TYPE_DATE],
        ['column' => 'dp.direccion', 'label' => 'Direccion paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'dp.serial_carnet', 'label' => 'Serial carnet paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'dp.embarazada', 'label' => 'Está embarazada', 'type' => DynamicReportComponent::TYPE_BOOLEAN],
        ['column' => 'parro.parroquia', 'label' => 'Parroquia paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'muni.municipio', 'label' => 'Municipio paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'edo.estado', 'label' => 'Estado paciente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'sexo.letra', 'label' => 'Sexo paciente (letra)', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'sexo.nombre', 'label' => 'Sexo paciente (descripcion)', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'nac.letra', 'label' => 'Nacionalidad paciente (letra)', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'nac.descripcion', 'label' => 'Nacionalidad paciente (descripcion)', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'med.nb_producto', 'label' => 'Medicamento', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'pat.descripcion', 'label' => 'Patologia', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'soli.dosis', 'label' => 'Dosis', 'type' => DynamicReportComponent::TYPE_NUMBER],
        ['column' => 'soli.frecuencia', 'label' => 'Frecuencia', 'type' => DynamicReportComponent::TYPE_NUMBER],
        ['column' => 'soli.cantidad_mensual', 'label' => 'Cantida mensual', 'type' => DynamicReportComponent::TYPE_NUMBER],
        ['column' => 'frec.frecuencias', 'label' => 'Tipo frecuencia', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'ente.descripcion', 'label' => 'Ente', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'hsoli.fecha', 'label' => 'Fecha solicitud', 'type' => DynamicReportComponent::TYPE_DATE],
        ['column' => 'usu.usuario', 'label' => 'Usuario registrador', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'usu.cedula', 'label' => 'Cedula usuario', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'usu.nombre', 'label' => 'Nombre usuario', 'type' => DynamicReportComponent::TYPE_STRING],
        ['column' => 'usu.apellido', 'label' => 'Apellido usuario', 'type' => DynamicReportComponent::TYPE_STRING],
    ]);

    $filtro->validate('fields');

    if ($filtro->load(Yii::$app->request->post()) && $filtro->validate()) {
        $query = (new \yii\db\Query)
            ->from(\frontend\models\DatosPersona::tableName() . ' dp')
            ->leftJoin(\common\models\Parroquia::tableName() . ' parro', 'parro.codigo_parroquia = dp.codigo_parroquia')
            ->leftJoin(\common\models\Municipio::tableName() . ' muni', 'muni.codigo_municipio = parro.codigo_municipio')
            ->leftJoin(\common\models\Estado::tableName() . ' edo', 'edo.codigo_estado = muni.codigo_estado')
            ->leftJoin(\frontend\models\Solicitud::tableName() . ' soli', 'dp.id = soli.id_datos_persona')
            ->leftJoin(\common\models\MedicamentoSibo::tableName() . ' med', 'med.id_producto = soli.id_medicamento')
            ->leftJoin(\common\models\Frecuencias::tableName() . ' frec', 'frec.id = soli.id_frecuencia')
            ->leftJoin(\common\models\Cie10Categoria::tableName() . ' pat', 'pat.id = soli.id_patologia')
            ->leftJoin(\common\models\Sexo::tableName() . ' sexo', 'sexo.id = dp.id_sexo')
            ->leftJoin(\common\models\Nacionalidad::tableName() . ' nac', 'nac.id = dp.id_nacionalidad')
            ->leftJoin(\common\models\Ente::tableName() . ' ente', 'ente.id = dp.trabajador_id_ente')
            ->leftJoin(\backend\models\HSoli::tableName() . ' hsoli', 'hsoli.id_solicitud = soli.id')
            ->leftJoin(\common\models\Usuario::tableName() . ' usu', 'usu.id = hsoli.id_usuario');

        $dynamicReport = new DynamicReportComponent($filtro->fields, $query);
        $dynamicReport->setSelectData( $filtro->select, $filtro->dataGetTypes, $filtro->dataSort );

        $where = ['soli.activo' => true];
        $dynamicReport->setWhereData( $filtro->whereColumn, $filtro->whereOperator, $filtro->whereCondition );
        $dynamicReport->addCondition( $where );

        $file = Yii::getAlias('@webroot').'/archivos/temp/temp'.rand().'.csv';

        $dynamicReport->getCsv($file, 'Reporte dinamico');
    }

    ArrayHelper::multisort($filtro->fields, 'column');
    $columnsList = ArrayHelper::map($filtro->fields, 'id', 'label');
    $columnsListOptions = [];

    foreach ($filtro->fields as $row) {
        $columnsListOptions[ $row['id'] ] = [
            'data-type' => $row['type'],
        ];
    }

    return $this->render('dinamico', [
      'model' => $filtro,
      'columnsList' => $columnsList,
      'columnsListOptions' => $columnsListOptions,
    ]);
  }
}
