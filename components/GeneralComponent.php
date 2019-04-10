<?php
namespace app\components;


use Yii;
use yii\base\Component;
 
class GeneralComponent extends Component
{
    /**
     * Get an age
     * @param date $birthday
     * @param date $compareDate The date to use to get the age
     * @return integer|boolean The age | false if isn't a valid age
     */
    public static function getAge($birthday, $compareDate=null)
    {
        if ($compareDate == null) {
            $currentTime = time();
        } else {
            $currentTime = strtotime($compareDate);
        }

        $birthTime = strtotime($birthday);

        if ($currentTime < 1 || $birthTime < 1) {
            //var_dump($currentTime, $birthTime);
            return false;
        }

        $age = (int) date('Y', $currentTime) - (int) date('Y', $birthTime);

        $currentMonth = (int) date('m', $currentTime);
        $birthMonth = (int) date('m', $birthTime);

        if ($currentMonth < $birthMonth) {
            $age--;
        } else if ($currentMonth == $birthMonth) {
            $currentDay = (int) date('d', $currentTime);
            $birthDay = (int) date('d', $birthTime);

            if ($currentDay < $birthDay) {
                $age--;
            }
        }

        return $age;
    }
}