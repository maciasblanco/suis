<?php

namespace app\modules\organizacion_sanitaria\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comunidad;

/**
 * ComunidadSearch represents the model behind the search form of `app\models\Comunidad`.
 */
class ComunidadSearch extends Comunidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_parroquia', 'cant_casas', 'poblacion'], 'integer'],
            [['codigo_comunidad', 'comunidad'], 'safe'],
            [['eliminado'], 'boolean'],
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
        $query = Comunidad::find();

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
            'id' => $this->id,
            'id_parroquia' => $this->id_parroquia,
            'cant_casas' => $this->cant_casas,
            'poblacion' => $this->poblacion,
            'eliminado' => $this->eliminado,
        ]);

        $query->andFilterWhere(['ilike', 'codigo_comunidad', $this->codigo_comunidad])
            ->andFilterWhere(['ilike', 'comunidad', $this->comunidad]);

        return $dataProvider;
    }
}
