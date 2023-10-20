<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $subject;
    public $password;
    public $contact_number;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['first_name', 'last_name', 'email', 'password', 'contact_number'], 'required'],
            // email has to be a valid email address
            ['email', 'email',],

            ['password', 'string', 'min' => 8],

            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

        ];
    }
}
