<?php

namespace app\modules\vacunaciones\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\vacunaciones\models\DatosPersona;

/**
 * DatosPersonaSearch represents the model behind the search form of `app\modules\vacunaciones\models\DatosPersona`.
 */
class DatosPersonaSearch extends DatosPersona
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parroquia_id'], 'integer'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'nacionalidad', 'sexo', 'fechanac', 'codigo_carnet', 'serial_carnet'], 'safe'],
            [['cedula', 'telefono'], 'number'],
            [['carnet_patria'], 'boolean'],
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
        $query = DatosPersona::find();

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
            'parroquia_id' => $this->parroquia_id,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'fechanac' => $this->fechanac,
            'carnet_patria' => $this->carnet_patria,
        ]);

        $query->andFilterWhere(['ilike', 'primer_nombre', $this->primer_nombre])
            ->andFilterWhere(['ilike', 'segundo_nombre', $this->segundo_nombre])
            ->andFilterWhere(['ilike', 'primer_apellido', $this->primer_apellido])
            ->andFilterWhere(['ilike', 'segundo_apellido', $this->segundo_apellido])
            ->andFilterWhere(['ilike', 'nacionalidad', $this->nacionalidad])
            ->andFilterWhere(['ilike', 'sexo', $this->sexo])
            ->andFilterWhere(['ilike', 'codigo_carnet', $this->codigo_carnet])
            ->andFilterWhere(['ilike', 'serial_carnet', $this->serial_carnet]);

        return $dataProvider;
    }
}
