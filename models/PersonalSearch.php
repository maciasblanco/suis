<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Personal;

/**
 * PersonalSearch represents the model behind the search form about `frontend\models\Personal`.
 */
class PersonalSearch extends Personal
{
    public $own_edo_search; 
    public $own_parro_search;
    public $own_asic_search;
    public $own_cirugia_search;
    public $own_est_pre_search; //EstatusPreoperatorio
    public $own_usuario;

    public function rules()
    {
        return [
            [['id', 'id_nac', 'cedula', 'id_sexo', 'id_usuario', 'id_padre', 'hijo', 'own_edo_search', 'own_est_pre_search','operado','validar'], 'integer'],
            [['nombre', 'apellido', 'fecha_nac', 'tlf_cel', 'tlf_local', 'own_asic_search', 'own_cirugia_search', 'own_parro_search', 'confirmado_carnet','own_usuario'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Personal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith([
            'datosContacto.codParroquia parro',
            'datosContacto.codParroquia.codigoMunicipio.codigoEstado edo',
            'datosContacto.idAsic a',
            'preoperatorio.estatusPreoperatorio estpre',
            'soliCirugias sc',
            'idUsuario usu'
            ]);
        $query->groupBy($this->tableName().'.id');
	$query->orderBy($this->tableName().'.id', 'DESC');

        if (Yii::$app->session->get('rol_id') == 2)
          $query->andFilterWhere(['id_usuario'=>Yii::$app->user->id]);
        else if (!in_array(Yii::$app->session->get('rol_id'), [1]))
          $query->andFilterWhere(['id_usuario'=>0]);
         if (Yii::$app->session->get('rol_id') == 1 && Yii::$app->user->identity->edo != NULL)
         $query->andFilterWhere(['edo.codigo_estado'=>Yii::$app->user->identity->edo]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_nac' => $this->id_nac,
            'fecha_nac' => $this->fecha_nac,
            'id_sexo' => $this->id_sexo,
            'id_padre' => $this->id_padre,
            'hijo' => $this->hijo,
            'edo.codigo_estado'=>$this->own_edo_search,
            'sc.id_cirugia'=>$this->own_cirugia_search,
            'parro.codigo_parroquia' => $this->own_parro_search,
            'estpre.id' => $this->own_est_pre_search,
            'confirmado_carnet' => $this->confirmado_carnet,
            'validar' => $this->validar,
            'operado' => $this->operado,
            'usu.id' => $this->id_usuario,

        ]);

       
                                             
        $query->andFilterWhere(['like', 'UPPER('.Personal::tableName().'.nombre)', mb_strtoupper($this->nombre, 'UTF-8')])
            ->andFilterWhere(['like', 'UPPER(apellido)', mb_strtoupper($this->apellido, 'UTF-8')])
            ->andFilterWhere(['like', 'UPPER(a.nombre_asic)', mb_strtoupper($this->own_asic_search, 'UTF-8')])
            ->andFilterWhere(['like', 'UPPER(cedula)', mb_strtoupper($this->cedula, 'UTF-8')]);
//var_dump($query->createCommand()->getSql());die;
        return $dataProvider;
    }
}
