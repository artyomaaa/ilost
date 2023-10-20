<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 12/1/2018
 * Time: 3:38 PM
 */

namespace app\models;


use yii\base\Model;

class ConfirmNewPassword extends Model
{
    public $new_password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['new_password', 'string', 'min' => 8],
        ];
    }
}