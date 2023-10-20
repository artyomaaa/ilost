<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 8/20/2018
 * Time: 6:30 PM
 */

namespace app\models;


use yii\db\ActiveRecord;


class FindImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'find_images';
    }



    public function getFind()
    {
        return $this->hasOne(Find::className(), ['id' => 'find_id']);
    }
}