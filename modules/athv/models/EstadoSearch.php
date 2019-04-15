<?php

namespace app\modules\athv\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\athv\models\Estado;

/**
 * EstadoSearch represents the model behind the search form of `app\modules\athv\models\Estado`.
 */
class EstadoSearch extends Estado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_estado', 'estado'], 'safe'],
            [['id_edofarma'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Estado::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_edofarma' => $this->id_edofarma,
        ]);

        $query->andFilterWhere(['ilike', 'codigo_estado', $this->codigo_estado])
            ->andFilterWhere(['ilike', 'estado', $this->estado]);

        return $dataProvider;
    }
}
