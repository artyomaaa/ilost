<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            //validate email
            ['email', 'email'],
            //
            [['email'], 'validateEmail'],
            //
            ['password', 'string', 'min' => 8],
            //
            [['password'], 'validatePassword']

        ];
    }

    /**
     * @param $attribute
     */
    public function validateEmail($attribute)
    {
        $session = Yii::$app->session;
        $language = $session->get('language');
        $email = User::find()->where(['email' => $this->email, 'verify' => 1])->one();
        if (empty($email)) {
            if ($language === 'en/') {
                $this->addError($attribute, 'This email is wrong.Write your email address in iLost.');
            } else {
                $this->addError($attribute, 'Այս էլ.հասցեն սխալ է: Գրեք ձեր էլ.հասցեն iLost- ում:');
            }
            return;
        }
    }

    /**
     * @param $attribute
     */
    public function validatePassword($attribute)
    {
        $session = Yii::$app->session;
        $language = $session->get('language');
        $email = User::find()->where(['email' => $this->email, 'verify' => 1])->one();
        $hash = $email['password'];
        if ($hash === null) {
            return;
        } else {
            if (Yii::$app->getSecurity()->validatePassword($this->password, $hash)) {
                $session->open();
                $session->set('user_id', $email['id']);
                $session->set('email', $email['email']);
            } else {
                if ($language === 'en/') {
                    $this->addError($attribute, 'Wrong password.');
                } else {
                    $this->addError($attribute, 'Սխալ գաղտնաբառ։');
                }
            }
        }


    }
}
