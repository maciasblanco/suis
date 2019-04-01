<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\components\DynamicReportComponent;

class DynamicReportFilter extends Model {
    public $fields;

    //SELECT
    public $select;
    public $dataGetTypes;

    //WHERE
    public $whereColumn;
    public $whereOperator;
    public $whereCondition;

    //ORDER
    public $dataSort;

    public $selList; //Fields for the SELECT
    public $getList; //Type of value to get
    public $filterList; //Fields for the WHERE
    public $filterOperator; //Operators for the WHERE
    public $filterConditionValueString; //Value for the WHERE condition
    public $filterConditionValueDate; //Value for the WHERE condition
    public $filterConditionValueBoolean; //Value for the WHERE condition

    /**
     * Constructor override
     */
    public function __construct($fields, $config = [])
    {
        $this->fields = $fields;

        if (is_array($this->fields)) {
            foreach ($this->fields as $n => $row) {
                $this->fields[$n]['id'] = $n;
            }
        }

        parent::__construct($config);
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'selList' => 'Campo a consultar',
            'getList' => 'Qué consultar',
            'filterList' => 'Campo a condicionar',
            'filterOperator' => 'Operador',
            'filterConditionValueString' => 'Condición',
            'filterConditionValueDate' => 'Condición',
            'filterConditionValueBoolean' => 'Condición',
        ];
    }

    /**
     * Validates the fields attribute
     */
    public function validateFields($attribute, $params, $validator)
    {
        $row = $this->$attribute;

        if (!is_array($row)) {
            $validator->addError($this, $attribute, '{attribute} debe ser un array.');
            return false;
        }

        if ( !array_key_exists('id', $row) ) {
            $validator->addError($this, $attribute, '{attribute} debe tener un indice "id".');
        } else if ( !is_numeric($row['id']) ) {
            $validator->addError($this, $attribute, 'El "id" debe tener un valor numérico.');
        }

        if ( !array_key_exists('column', $row) ) {
            $validator->addError($this, $attribute, '{attribute} debe tener un indice "column".');
        } else if ( !preg_match('/^[A-Za-z0-9_]+\.[A-Za-z0-9_]*$/', $row['column']) ) {
            $validator->addError($this, $attribute, '"' . $row['column'] . '" no es una columna valida.');
        }

        if ( !array_key_exists('type', $row) ) {
            $validator->addError($this, $attribute, '{attribute} debe tener un indice "type".');
        } else if ( !in_array($row['type'], DynamicReportComponent::dataTypeOptions()) ) {
            $validator->addError($this, $attribute, '"type" no válido.');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fields'], 'each', 'rule' => ['validateFields']],
            [['select', 'dataGetTypes'], 'required'],
            [['whereCondition', 'dataSort'], 'safe'],
            [['whereOperator'], 'each', 'rule' => ['in', 'range' => DynamicReportComponent::whereOperators()]],
            [['select', 'whereColumn'], 'each', 'rule' => ['in', 'range' => ArrayHelper::getColumn($this->fields, 'id')]],
            [['dataGetTypes'], 'each', 'rule' => ['in', 'range' => DynamicReportComponent::dataGetOptions()]],

            [[
                'selList', 'getList', 'filterList', 'filterOperator', 
                'filterConditionValueString', 'filterConditionValueDate', 'filterConditionValueBoolean'
            ], 'string'],
        ];
    }
}