<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/23/2018
 * Time: 9:27 PM
 */

namespace app\helpers;

use app\models\User;

class UserUpdate
{
    /**
     * @param $post
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function getUserUpdate($post)
    {
        $user = User::find()->where(['id' => $post['user_id']])->one();
        $user->first_name = $post['first_name'];
        $user->last_name = $post['last_name'];
        $user->contact_number = $post['contact_number'];
        $user->update();
    }

}