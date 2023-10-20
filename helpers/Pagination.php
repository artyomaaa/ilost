<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/22/2018
 * Time: 10:00 PM
 */

namespace app\helpers;


use yii\data\ArrayDataProvider;

class Pagination
{
    public static function Pagination($data, $pageSize = 9)
    {
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
        return $provider;
    }
}