<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/16/2018
 * Time: 5:51 PM
 */

namespace app\models;


use yii\base\Model;

class Statement extends Model
{
    public $inputTitle;
    public $contact;
    public $category;

    /**
     * @return array
     */
    public function rules()
    {

        return [

            [['inputTitle', 'contact', 'category'], 'required'],

        ];
    }

}