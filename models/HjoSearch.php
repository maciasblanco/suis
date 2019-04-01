<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Hijo;

/**
 * HjoSearch represents the model behind the search form about `frontend\models\Hijo`.
 */
class HjoSearch extends Hijo
{
    public function rules()
    {
        return [
            [['id', 'id_nac', 'hijo', 'id_sexo', 'id_padre'], 'integer'],
            [['nombre', 'apellido', 'fecha_nac'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Hijo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_nac' => $this->id_nac,
            'hijo' => $this->hijo,
            'fecha_nac' => $this->fecha_nac,
            'id_sexo' => $this->id_sexo,
            'id_padre' => $this->id_padre,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido]);

        return $dataProvider;
    }
}
