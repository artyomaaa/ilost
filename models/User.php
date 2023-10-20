<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 8/9/2018
 * Time: 8:01 PM
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'users';
    }


}