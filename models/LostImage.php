<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 8/20/2018
 * Time: 3:56 PM
 */


namespace app\models;


use yii\db\ActiveRecord;


class LostImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'lost_images';
    }

    public function getLost()
    {
        return $this->hasOne(Lost::className(), ['id' => 'lost_id']);
    }

}