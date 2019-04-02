<?php
namespace app\components;

use yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class UserIpBehavior extends AttributeBehavior
{
    public $updatedAttribute = 'updated_ip';

    //Valor por defecto, puede ser un texto o una funcion anonima
    public $value;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                ActiveRecord::EVENT_BEFORE_INSERT => $this->updatedAttribute,
                ActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedAttribute,
            ];
        }
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event) {
        if (is_string($this->value)) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : Yii::$app->request->userIp;
        }
    }
}