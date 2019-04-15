<?php

namespace app\modules\vacunaciones\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\vacunaciones\models\Establecimiento;

/**
 * EstablecimientoSearch represents the model behind the search form of `app\modules\vacunaciones\models\Establecimiento`.
 */
class EstablecimientoSearch extends Establecimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'padre', 'htipo', 'hlocalidad', 'hnivel', 'hasic', 'hdependencia_adm', 'hejes', 'ncamas', 'camhip', 'corposalud', 'horario', 'htipo2'], 'integer'],
            [['codigo', 'nombre', 'direccion', 'telefono', 'status', 'fechaoperacion', 'descripcion', 'funcionamiento', 'icono', 'usuario', 'rif', 'nombrelargo_comu', 'nombrelargo_trad'], 'safe'],
            [['x_utm', 'y_utm', 'altitud', 'nropersonas', 'cantidadfamilia', 'cuentadante'], 'number'],
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
        $query = Establecimiento::find();

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
            'padre' => $this->padre,
            'htipo' => $this->htipo,
            'hlocalidad' => $this->hlocalidad,
            'fechaoperacion' => $this->fechaoperacion,
            'hnivel' => $this->hnivel,
            'x_utm' => $this->x_utm,
            'y_utm' => $this->y_utm,
            'altitud' => $this->altitud,
            'hasic' => $this->hasic,
            'hdependencia_adm' => $this->hdependencia_adm,
            'nropersonas' => $this->nropersonas,
            'hejes' => $this->hejes,
            'cantidadfamilia' => $this->cantidadfamilia,
            'ncamas' => $this->ncamas,
            'camhip' => $this->camhip,
            'corposalud' => $this->corposalud,
            'horario' => $this->horario,
            'cuentadante' => $this->cuentadante,
            'htipo2' => $this->htipo2,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'telefono', $this->telefono])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'funcionamiento', $this->funcionamiento])
            ->andFilterWhere(['ilike', 'icono', $this->icono])
            ->andFilterWhere(['ilike', 'usuario', $this->usuario])
            ->andFilterWhere(['ilike', 'rif', $this->rif])
            ->andFilterWhere(['ilike', 'nombrelargo_comu', $this->nombrelargo_comu])
            ->andFilterWhere(['ilike', 'nombrelargo_trad', $this->nombrelargo_trad]);

        return $dataProvider;
    }
}
