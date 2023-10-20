<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/9/2018
 * Time: 12:18 AM
 */

namespace app\helpers;


use Yii;

class Mailer
{
    /**
     * @param $html
     * @param $email
     * @param null $admin_email
     * @param null $admin_name
     * @param null $post
     * @param null $mailSubject
     * @param null $replay
     */
    public static function createSendEmail($html,  $email, $admin_email = null, $admin_name = null, $post = null, $mailSubject = null, $replay =null)
    {
        Yii::$app->mailer->compose($html, ['post' => $post])
            ->setTo($email)
            ->setFrom([$admin_email => $admin_name])
            ->setReplyTo($replay)
            ->setSubject($mailSubject)
            ->send();
    }
}