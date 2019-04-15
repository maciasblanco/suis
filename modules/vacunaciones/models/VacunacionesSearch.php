<?php

namespace app\modules\vacunaciones\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\vacunaciones\models\Vacunaciones;

/**
 * VacunacionesSearch represents the model behind the search form of `app\modules\vacunaciones\models\Vacunaciones`.
 */
class VacunacionesSearch extends Vacunaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_dato_persona', 'id_vacuna', 'id_dosis', 'id_establecimiento', 'id_grupo_edad', 'id_tipo_mision', 'n_hijo', 'id_tipo_vacunacion', 'id_condicion_especial'], 'integer'],
            [['fecha', 'lote_amarilica', 'nombres_menor', 'apellidos_menor', 'fecha_nac', 'sexo'], 'safe'],
            [['menor_edad'], 'boolean'],
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
        $query = Vacunaciones::find();

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
            'id_dato_persona' => $this->id_dato_persona,
            'fecha' => $this->fecha,
            'id_vacuna' => $this->id_vacuna,
            'id_dosis' => $this->id_dosis,
            'id_establecimiento' => $this->id_establecimiento,
            'id_grupo_edad' => $this->id_grupo_edad,
            'id_tipo_mision' => $this->id_tipo_mision,
            'n_hijo' => $this->n_hijo,
            'id_tipo_vacunacion' => $this->id_tipo_vacunacion,
            'id_condicion_especial' => $this->id_condicion_especial,
            'menor_edad' => $this->menor_edad,
            'fecha_nac' => $this->fecha_nac,
        ]);

        $query->andFilterWhere(['ilike', 'lote_amarilica', $this->lote_amarilica])
            ->andFilterWhere(['ilike', 'nombres_menor', $this->nombres_menor])
            ->andFilterWhere(['ilike', 'apellidos_menor', $this->apellidos_menor])
            ->andFilterWhere(['ilike', 'sexo', $this->sexo]);

        return $dataProvider;
    }
}
