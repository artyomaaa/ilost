<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/20/2018
 * Time: 12:15 PM
 */

namespace app\models;

use app\helpers\Mailer;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

class ChangeForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $contact_number;
    public $old_password;
    public $new_password;
    public $user_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //validate old password
            [['old_password', 'user_id'], 'validatePassword'],
            //email must be email
            ['email', 'email'],
            //This email address has already been taken?
            ['email', 'validateEmail',],
            // name, email, subject and body are required
            [['first_name', 'last_name', 'email', 'contact_number'], 'required'],
            // email has to be a valid email address
        ];
    }


    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * @param $attribute
     * @throws \Throwable
     * @throws \yii\base\Exception
     * @throws \yii\db\StaleObjectException
     */
    public function validatePassword($attribute)
    {
        if (!empty($this->old_password) && !empty($this->new_password)) {
            $user_data = User::find()->where(['id' => $this->user_id])->one();
            $hash = $user_data->password;
            if (Yii::$app->getSecurity()->validatePassword($this->old_password, $hash)) {
                $cryptPass = Yii::$app->getSecurity()->generatePasswordHash($this->new_password);
                $user_data->password = $cryptPass;
                $user_data->update();
            } else {
                $this->addError($attribute, 'Old password is incorrect.');
            }
        }
    }

    /**
     * @param $attribute
     * @throws \yii\base\Exception
     */
    public function validateEmail($attribute)
    {
        $session = Yii::$app->session;
        $session->open();
        $email = $session->get('email');
        if ($email !== $this->email) {
            if (User::find()->where(['email' => $this->email])->one()) {
                $this->addError($attribute, 'This email address has already been taken.');
            }
        }
    }
}