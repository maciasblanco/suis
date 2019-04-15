<?php

namespace app\modules\athv\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\athv\models\HechoViolento;

/**
 * HechoViolentoSearch represents the model behind the search form of `app\modules\athv\models\HechoViolento`.
 */
class HechoViolentoSearch extends HechoViolento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_parroquia', 'id_lugar_hecho', 'id_sitio_muerte', 'id_tipo_hecho', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_objeto_hecho'], 'integer'],
            [['direccion', 'observacion'], 'safe'],
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
        $query = HechoViolento::find();

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
            'id_lugar_hecho' => $this->id_lugar_hecho,
            'id_sitio_muerte' => $this->id_sitio_muerte,
            'id_tipo_hecho' => $this->id_tipo_hecho,
            'id_diagnostico_asociado' => $this->id_diagnostico_asociado,
            'id_diagnostico_ubicacion' => $this->id_diagnostico_ubicacion,
            'id_objeto_hecho' => $this->id_objeto_hecho,
        ]);

        $query->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
