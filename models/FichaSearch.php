<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Ficha;

/**
 * FichaSearch represents the model behind the search form about `frontend\models\Ficha`.
 */
class FichaSearch extends Ficha
{
    public function rules()
    {
        return [
            [['id', 'id_tipo_requerimiento', 'id_tipo_solicitud', 'id_estatus', 'id_datos_personales', 'id_enfermedad', 'id_tratamiento', 'id_discapacidad'], 'integer'],
            [['fecha_solicitud', 'fecha_registro', 'descripcion'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Ficha::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_tipo_requerimiento' => $this->id_tipo_requerimiento,
            'id_tipo_solicitud' => $this->id_tipo_solicitud,
            'id_estatus' => $this->id_estatus,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_registro' => $this->fecha_registro,
            'id_datos_personales' => $this->id_datos_personales,
            'id_enfermedad' => $this->id_enfermedad,
            'id_tratamiento' => $this->id_tratamiento,
            'id_discapacidad' => $this->id_discapacidad,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
