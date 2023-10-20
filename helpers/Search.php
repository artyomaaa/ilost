<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/22/2018
 * Time: 5:28 PM
 */

namespace app\helpers;


use app\models\Find;
use app\models\Lost;

class Search
{
    public static function Search($search)
    {
        $searchInLost = Lost::find()
            ->orwhere([
                'LIKE', 'title', '%' . $search . '%', false,
            ])
            ->orWhere(['LIKE', 'text', '%' . $search . '%', false,])
            ->all();
        $searchInFind = Find::find()
            ->orwhere([
                'LIKE', 'title', '%' . $search . '%', false,
            ])
            ->orWhere(['LIKE', 'text', '%' . $search . '%', false,])
            ->all();
        $findin = array_merge($searchInLost, $searchInFind);
        return $findin;
    }
}