<?php

namespace app\modules\athv\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\athv\models\Parroquia;

/**
 * ParroquiaSearch represents the model behind the search form of `app\modules\athv\models\Parroquia`.
 */
class ParroquiaSearch extends Parroquia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_parroquia', 'parroquia', 'codigo_municipio'], 'safe'],
            [['id_parrofarma', 'id_parroquia'], 'integer'],
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
        $query = Parroquia::find();

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
            'id_parrofarma' => $this->id_parrofarma,
            'id_parroquia' => $this->id_parroquia,
        ]);

        $query->andFilterWhere(['ilike', 'codigo_parroquia', $this->codigo_parroquia])
            ->andFilterWhere(['ilike', 'parroquia', $this->parroquia])
            ->andFilterWhere(['ilike', 'codigo_municipio', $this->codigo_municipio]);

        return $dataProvider;
    }
}
