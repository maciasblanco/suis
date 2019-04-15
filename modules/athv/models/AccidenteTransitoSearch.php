<?php

namespace app\modules\athv\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\athv\models\AccidenteTransito;

/**
 * AccidenteTransitoSearch represents the model behind the search form of `app\modules\athv\models\AccidenteTransito`.
 */
class AccidenteTransitoSearch extends AccidenteTransito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_parroquia', 'id_sitio_muerte', 'id_tipo_accidente', 'id_tipo_vehiculo', 'id_tipo_afectado', 'id_diagnostico_asociado', 'id_diagnostico_ubicacion', 'id_dato_persona'], 'integer'],
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
        $query = AccidenteTransito::find();

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
            'id_sitio_muerte' => $this->id_sitio_muerte,
            'id_tipo_accidente' => $this->id_tipo_accidente,
            'id_tipo_vehiculo' => $this->id_tipo_vehiculo,
            'id_tipo_afectado' => $this->id_tipo_afectado,
            'id_diagnostico_asociado' => $this->id_diagnostico_asociado,
            'id_diagnostico_ubicacion' => $this->id_diagnostico_ubicacion,
            //'id_dato_persona' => $this->id_dato_persona,
        ]);

        $query->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'observacion', $this->observacion]);

        return $dataProvider;
    }
}
