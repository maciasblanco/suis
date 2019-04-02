<?php
namespace app\components;

use yii;
use yii\base\BaseObject;

class DynamicReportComponent extends BaseObject
{
    const GET_VALUE = 1;
    const GET_COUNT = 2;
    const GET_SUM = 3;

    const TYPE_STRING = 1;
    const TYPE_NUMBER = 2;
    const TYPE_DATE = 3;
    const TYPE_BOOLEAN = 4;

    const OPE_LESS = '<';
    const OPE_LESS_EQ = '<=';
    const OPE_GREATER = '>';
    const OPE_GREATER_EQ = '>=';
    const OPE_EQUAL = '=';
    const OPE_DIFF = '!=';
    const OPE_LIKE = 'ilike';
    const OPE_IN = 'in';

    const PREFIX_SUM = 'SUM ';
    const PREFIX_COUNT = 'NUM ';

    public $columns;
    public $baseQuery;
    public $query;

    public $selectSeted;
    public $needGroup;
    public $askVaue;
    public $askCount;
    public $askSum;

    /**
     * @inheritdoc
     */
    public function __construct($columns, $baseQuery, $config = [])
    {
        $this->columns = $columns;

        if (is_array($this->columns)) {
            foreach ($this->columns as $n => $row) {
                $this->columns[$n]['id'] = $n;
            }
        }

        $this->baseQuery = $baseQuery;
        $this->query = clone $baseQuery;
        $this->selectSeted = false;

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return Array The options for the SQL "SELECT"
     */
    public static function dataGetOptions()
    {
        return [self::GET_VALUE, self::GET_COUNT, self::GET_SUM];
    }

    /**
     * @return Array The valid types of data
     */
    public static function dataTypeOptions()
    {
        return [self::TYPE_STRING, self::TYPE_NUMBER, self::TYPE_DATE, self::TYPE_BOOLEAN];
    }

    /**
     * @return Array The operators for the where
     */
    public static function whereOperators()
    {
        return [self::OPE_LESS, self::OPE_LESS_EQ, self::OPE_GREATER, self::OPE_GREATER_EQ, self::OPE_EQUAL, self::OPE_DIFF, self::OPE_LIKE, self::OPE_IN];
    }

    /**
     * @return The query
     */
    public function getQuery()
    {
        return $this->query->createCommand()->getSql();
    }

    /**
     * @param $id integer The id of the column
     * @return integer The column index
     */
    public function getColumnIndexById($id)
    {
        foreach ($this->columns as $n => $row) {
            if ($row['id'] == $id) {
                return $n;
            }
        }

        return null;
    }

    /**
     * Sets the select and group by if necessary
     * @param $selectData Array The list of fields id
     * @param $getTypes Array The type of consult
     */
    public function setSelectData($selectData, $getTypes, $dataSort)
    {
        $this->query = clone $this->baseQuery;

        $this->needGroup = false;
        $this->askVaue = false;
        $this->askCount = false;
        $this->askSum = false;

        $select = [];
        $order = [];

        foreach ($selectData as $n => $sel) {
            $columnIndex = $this->getColumnIndexById($sel);
            $label = "";

            //Gets the label
            if (isset($this->columns[$columnIndex]['label'])) {
                $label = $this->columns[$columnIndex]['label'];
            } else {
                $label = $this->columns[$columnIndex]['column'];
            }

            //Set the type of SELECT
            switch ($getTypes[$n]) {
                case self::GET_VALUE:
                    $this->askVaue = true;
                    $select[ $label ] = $this->columns[$columnIndex]['column'];
                    break;
                
                case self::GET_COUNT:
                    $this->askCount = true;
                    $label = self::PREFIX_COUNT.$label;
                    $select[ $label ] = "(COUNT({$this->columns[$columnIndex]['column']}))";
                    break;
                
                case self::GET_SUM:
                    $this->askSum = true;
                    $label = self::PREFIX_SUM.$label;
                    $select[ $label ] = "(SUM({$this->columns[$columnIndex]['column']}))";
                    break;
            }

            //Sets the order
            if ($dataSort[$n] == "ASC") {
                $order[ $label ] = SORT_ASC;
            } else if ($dataSort[$n] == "DESC") {
                $order[ $label ] = SORT_DESC;
            }
        }

        //Check if is needed to us a GROUP BY
        if ($this->askVaue && ($this->askCount || $this->askSum)) {
            $this->needGroup = true;
        }

        //Sets the SELECT and ORDER
        $this->query->select( $select );
        $this->query->orderBy( $order );
        $this->selectSeted = true;

        //If is needed, sets the GROUP
        if ($this->needGroup) {
            $group = [];

            foreach ($selectData as $n => $sel) {
                $columnIndex = $this->getColumnIndexById($sel);

                if ($getTypes[$n] == self::GET_VALUE) {
                    $group[] = $this->columns[$columnIndex]['column'];
                }
            }

            $this->query->groupBy( $group );
        } else {
            $this->query->groupBy(null);
        }
    }

    /**
     * Sets the where condition
     * @param $columns Array The list of fields id
     * @param $operators Array The operators beign used
     * @param $conditions Array The values to perform the where query
     */
    public function setWhereData($columns, $operators, $conditions)
    {
        if (!empty($columns)) {
            foreach ($columns as $n => $colId) {
                $columnIndex = $this->getColumnIndexById($colId);

                //Gets the values no manage
                $columnName = $this->columns[$columnIndex]['column'];
                $columnOperator = $operators[$n];
                $columnType = $this->columns[$columnIndex]['type'];
                $columnConditionVal = $conditions[$n];

                if ($columnOperator == self::OPE_IN) {
                    $columnConditionVal = explode(',', $columnConditionVal);
                }

                if ($columnType == self::TYPE_DATE) {
                    $columnName = "TO_CHAR({$columnName}, 'yyyy-mm-dd')";
                    $columnConditionVal = date('Y-m-d', strtotime($conditions[$n]));
                } else if ($columnType == self::TYPE_STRING && $columnOperator == self::OPE_LIKE) {
                    $columnConditionVal = "{$columnConditionVal}";
                }

                $this->query->andWhere([$columnOperator, $columnName, $columnConditionVal]);
            }
        }
    }

    /**
     * Sets the where condition
     * @param $where String the condition to add
     */
    public function addCondition($where)
    {
        $this->query->andWhere($where);
    }

    /**
     * Return the query set of records
     */
    public function getData()
    {
        return $this->query->all();
    }

    /**
     * @param $file String the temp file name
     * @param $title String the final file name
     * Sends a CSV file
     */
    public function getCsv($file, $title) {
        $f = fopen($file, 'w');
        $data = $this->getData();

        if (!empty($data)){
            //Se escribe la cabecera del archivo
            $titulo = [];

            foreach ($data[0] as $col=>$val){
                $titulo[] = mb_strtoupper($col, 'UTF-8');
            }

            fwrite($f, implode(';', $titulo).PHP_EOL);

            foreach($data as $row){
                //$row['direccion'] = '"'.($row['direccion']).'"';
                fwrite($f, mb_strtoupper(trim(str_replace(["\r","\n"], " ", implode(';', $row))), 'UTF-8').PHP_EOL);
            }
      
        }

        fclose($f);

        ignore_user_abort();
    
        Yii::$app->response->sendFile($file, "{$title}.csv");
        unlink($file);
    }
}