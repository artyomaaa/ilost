<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/30/2018
 * Time: 9:23 PM
 */

namespace app\models;


use Yii;
use yii\base\Model;

class ConfirmCode extends Model
{
    public $code;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['code'], 'validateCode']
        ];
    }

    public function validateCode($attribute)
    {
        $session = Yii::$app->session;
        $forgot_key = $session->get('forgot_key');
        if ($forgot_key !== $this->code) {
            $language = $session->get('language');
            if (empty($language) || $language === 'am/') {
                $this->addError($attribute, 'Կոդը սխալ է։');
            } else {
                $this->addError($attribute, 'Wrong code.');

            }
        }
    }


}