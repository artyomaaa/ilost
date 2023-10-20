<?php


namespace app\models;


use yii\db\ActiveRecord;


class Find extends ActiveRecord
{
    public static function tableName()
    {
        return 'finds';
    }

    public static function getFinds($limit = false)
    {
        $result = Find::find()
            ->with('findImages')
            ->orderBy('id DESC')
            ->limit($limit)
            ->all();

        return $result;
    }

    public function getFindImages()
    {
        return $this->hasMany(FindImage::className(), ['find_id' => 'id']);
    }
}