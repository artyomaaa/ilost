<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/11/2018
 * Time: 3:08 PM
 */

namespace app\models;
use yii\base\Model;


class PostForm extends Model
{
    public $inputCountry;
    public $inputCity;
    public $inputAddress;
    public $inputTitle;
    public $contact;
    public $category;
    public $text;

    public function rules()
 {


     return [
         [['inputCountry', 'inputCity', 'inputAddress', 'inputTitle', 'contact', 'category', 'text'], 'required',],

         ['email', 'email'],
     ];
 }
}