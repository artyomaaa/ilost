<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 8/2/2018
 * Time: 7:48 PM
 */

namespace app\models;

use yii\base\Model;
use app\components\Helper as Helper;

class UploadForm extends Model
{
    public static function uploadFiles($contact, $img_kod)
    {
        if (isset($_FILES['image'])) {
            foreach ($_FILES["image"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["image"]["tmp_name"][$key];
                    $x = Helper::generateRandomString(15);
                    $name = $x . basename($_FILES["image"]["name"][$key]);
                    if ($contact === 'lost') {
                        $statement_id = Lost::find()->where(['img_kod' => $img_kod])->one();
                        $images = new LostImage([
                            'image' => $name,
                            'lost_id' => $statement_id->id,
                        ]);
                        $images->save();
                    } else {
                        $find_id = Find::find()->where(['img_kod' => $img_kod])->one();
                        $images = new FindImage([
                            'image' => $name,
                            'find_id' => $find_id->id,
                        ]);
                        $images->save();
                    }
                    move_uploaded_file($tmp_name, "uploads/$name");
                }
            }
        }
    }
}