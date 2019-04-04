<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalogo.grupo_epi12_cie10".
 *
 * @property int $id_cie10_subcategoria
 * @property int $id_grupo_epi12
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $updated_ip
 *
 * @property Cie10Subcategoria $cie10Subcategoria
 * @property GrupoEpi12 $grupoEpi12
 */
class GrupoEpi12Cie10 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo.grupo_epi12_cie10';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cie10_subcategoria', 'id_grupo_epi12', 'created_at', 'updated_at', 'created_by', 'updated_by', 'updated_ip'], 'default', 'value' => null],
            [['id_cie10_subcategoria', 'id_grupo_epi12'], 'required'],
            [['id_cie10_subcategoria', 'id_grupo_epi12', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['updated_ip'], 'string'],
            [['id_cie10_subcategoria', 'id_grupo_epi12'], 'unique', 'targetAttribute' => ['id_cie10_subcategoria', 'id_grupo_epi12']],
            [['id_cie10_subcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Cie10Subcategoria::className(), 'targetAttribute' => ['id_cie10_subcategoria' => 'id']],
            [['id_grupo_epi12'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoEpi12::className(), 'targetAttribute' => ['id_grupo_epi12' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cie10_subcategoria' => Yii::t('app', 'Id Cie10 Subcategoria'),
            'id_grupo_epi12' => Yii::t('app', 'Id Grupo Epi12'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_ip' => Yii::t('app', 'Updated Ip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCie10Subcategoria()
    {
        return $this->hasOne(Cie10Subcategoria::className(), ['id' => 'id_cie10_subcategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoEpi12()
    {
        return $this->hasOne(GrupoEpi12::className(), ['id' => 'id_grupo_epi12']);
    }

    /**
     * {@inheritdoc}
     * @return GrupoEpi12Cie10Query the active query used by this AR class.
     */
    public static function find()
    {
        return (new GrupoEpi12Cie10Query(get_called_class()))
            ->joinWith([
                'grupoEpi12' => function($query) {
                    return $query->alias('grupoEpi12')->orderBy([]);
                },
                'cie10Subcategoria' => function($query) {
                    return $query->alias('sub')->orderBy([]);
                },
            ]);
    }

    /**
     * 
     */
    public function getCodigoYSub()
    {
        $datos = [$this->cie10Subcategoria->codigo, $this->cie10Subcategoria->descripcion];

        return implode(' - ', $datos);
    }

    /**
     * 
     */
    public function getGrupoCodigoSub()
    {
        $grupo = $this->grupoEpi12->descripcion;
        $datos = [$this->cie10Subcategoria->codigo, $this->cie10Subcategoria->descripcion];

        $sub = implode(' - ', $datos);

        return "{$grupo}: {$sub}";
    }
}
