<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/30/2018
 * Time: 7:45 PM
 */

namespace app\models;


use Yii;
use yii\base\Model;

class Forgot extends Model
{
    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'validateEmail']
        ];
    }

    /**
     * @param $attribute
     */
    public function validateEmail($attribute)
    {
        $user_data = User::find()->where(['email' => $this->email])->one();
        if (empty($user_data)){
            $session = Yii::$app->session;
            $language = $session->get('language');
            if (empty($language) || $language === 'am/') {
                $this->addError($attribute, 'Այս էլ.հասցեն սխալ է: Գրեք ձեր էլ.հասցեն iLost- ում:');
            } else {
                $this->addError($attribute, 'This email is wrong.Write your email address in iLost.');

            }
        }

    }

}