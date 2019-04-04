<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GrupoEpi12]].
 *
 * @see GrupoEpi12
 */
class GrupoEpi12Query extends \yii\db\ActiveQuery
{
    public function enfermedades()
    {
        return $this->andWhere(['tipo' => GrupoEpi12::ENFERMEDAD]);
    }

    /**
     * {@inheritdoc}
     * @return GrupoEpi12[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrupoEpi12|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
