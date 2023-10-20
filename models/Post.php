<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/8/2018
 * Time: 5:34 PM
 */

namespace app\models;

use yii\db\ActiveRecord;


class Post extends ActiveRecord
{
    /**
     * @param $contact
     * @param $data
     * @param null $user_id
     * @param null $img_kod
     * @return Find|Lost
     */
    public static function createStatement($contact, $data, $user_id = null, $img_kod = null)
    {
        if ($contact === 'lost') {
            $result = new Lost([
                'country' => $data["inputCountry"],
                'city' => $data["inputCity"],
                'address' => $data["inputAddress"],
                'title' => $data["inputTitle"],
                'data' => $data["dataTime"],
                'text' => $data["text"],
                'category' => $data["category"],
                'contact' => $data["contact"],
                'user_id' => $user_id,
                'img_kod' => $img_kod,
            ]);
            $result->save();
            return $result;
        } else {
            $result = new Find([
                'country' => $data["inputCountry"],
                'city' => $data["inputCity"],
                'address' => $data["inputAddress"],
                'title' => $data["inputTitle"],
                'data' => $data["dataTime"],
                'text' => $data["text"],
                'category' => $data["category"],
                'contact' => $data["contact"],
                'user_id' => $user_id,
                'img_kod' => $img_kod,
            ]);
            $result->save();
            return $result;
        }
    }

    /**
     * @param $contact
     * @param $data
     * @param null $id
     * @param null $img_kod
     * @return array|null|ActiveRecord
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function createStatementUpdate($contact, $data, $id = null, $img_kod = null)
    {
        if ($contact === 'lost') {
            $change = Lost::find()->where(['id' => $id])->one();
            $change->country = $data["inputCountry"];
            $change->city = $data["inputCity"];
            $change->address = $data["inputAddress"];
            $change->title = $data["inputTitle"];
            $change->data = $data["dataTime"];
            $change->text = $data["text"];
            $change->category = $data["category"];
            $change->img_kod = $img_kod;
            $change->update();
            return $change;
        }else{
            $change = Find::find()->where(['id' => $id])->one();
            $change->country = $data["inputCountry"];
            $change->city = $data["inputCity"];
            $change->address = $data["inputAddress"];
            $change->title = $data["inputTitle"];
            $change->data = $data["dataTime"];
            $change->text = $data["text"];
            $change->category = $data["category"];
            $change->img_kod = $img_kod;
            $change->update();
            return $change;
        }
    }
}