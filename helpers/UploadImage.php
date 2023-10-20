<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/13/2018
 * Time: 12:28 AM
 */

namespace app\helpers;

use app\models\Find;
use app\models\FindImage;
use app\models\Lost;
use app\models\LostImage;
use Yii;

class UploadImage
{
    /**
     * @param $post
     * @param $img_kod
     * @throws \yii\base\Exception
     */
    public static function getFile($post, $img_kod, $user_id = null)
    {
        $count = count($post['image_data_array']);
        for ($i = 0; $i < $count; $i++) {
            $imgName = Yii::$app->getSecurity()->generateRandomString();
            $data = $post['image_data_array'][$i];
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('invalid image type');
                }
                $data = base64_decode($data);
                if ($data === false) {
                    throw new \Exception('base64_decode failed');
                }
            }
            if ($post['contact'] === 'lost') {
                $statement_id = Lost::find()->where(['img_kod' => $img_kod])->one();
                $images = new LostImage([
                    'image' => $imgName . ".{$type}",
                    'lost_id' => $statement_id['id'],
                ]);
                $images->save();
            } else {
                $statement_id = Find::find()->where(['img_kod' => $img_kod])->one();
                $images = new FindImage([
                    'image' => $imgName . ".{$type}",
                    'find_id' => $statement_id['id'],
                ]);
                $images->save();
            }
            file_put_contents("uploads/" . $imgName . ".{$type}", $data);
        }
    }
}