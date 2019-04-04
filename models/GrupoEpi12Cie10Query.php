<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GrupoEpi12Cie10]].
 *
 * @see GrupoEpi12Cie10
 */
class GrupoEpi12Cie10Query extends \yii\db\ActiveQuery
{
    public function enfermedades()
    {
        return $this->andWhere(['grupoEpi12.tipo' => GrupoEpi12::ENFERMEDAD]);
    }

    /**
     * {@inheritdoc}
     * @return GrupoEpi12Cie10[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrupoEpi12Cie10|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
