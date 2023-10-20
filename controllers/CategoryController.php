<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 9/20/2018
 * Time: 4:46 PM
 */

namespace app\controllers;

use app\models\Find;
use app\models\Lost;
use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $session = Yii::$app->session;
        $language = $session->get('language');
        if (!empty($language)) {
            $this->layout = $language . 'main';
        } else {
            $this->layout = 'am/main';
        }

        return parent::beforeAction($action);

    }

    /**
     * @param $category_name
     * @param $category
     * @return string
     */
    public function actionIndex($category_name, $category)
    {
        if (!empty($category) && $category === 'lost') {
            $lostThing = Lost::find()->where(['category' => $category_name])->orderBy('id DESC')->all();
            $session = Yii::$app->session;
            $language = $session->get('language');
            if (!empty($language)) {
                return $this->render('/site/' . $language . 'lost', ["lostThing" => $lostThing, 'category_name' => $category_name]);
            } else {
                return $this->render('/site/am/lost', ["lostThing" => $lostThing, 'category_name' => $category_name]);
            }
        } else {
            $findThing = Find::find()->where(['category' => $category_name])->orderBy('id DESC')->all();
            $session = Yii::$app->session;
            $language = $session->get('language');
            if (!empty($language)) {
                return $this->render("/site/" . $language . 'find', ["findThing" => $findThing, 'category_name' => $category_name]);
            } else {
                return $this->render('/site/am/find', ["findThing" => $findThing, 'category_name' => $category_name]);
            }
        }
    }

    /**
     * @return string
     */
    public function actionSearchInCategory()
    {
        $category_name = $_GET['category_name'];
        $search_category = $_GET['search_category'];
        $category = $_GET['category'];
        if (!empty($category_name) || !empty($search_category) || !empty($category)) {
            if ($category === 'lost') {
                $lostThing = Lost::find()
                    ->where(['category' => $category_name])
                    ->andwhere(['or', ['LIKE', 'title', '%' . $search_category . '%', false,], ['LIKE', 'text', '%' . $search_category . '%', false,]])
                    ->orderBy('id DESC')
                    ->all();

                $session = Yii::$app->session;
                $language = $session->get('language');

                if (!empty($language)) {
                    return $this->render('/site/' . $language . 'lost', ["lostThing" => $lostThing, 'category_name' => $category_name,]);
                } else {
                    return $this->render('/site/am/lost', ["lostThing" => $lostThing, 'category_name' => $category_name,]);
                }
            } else {
                $findThing = Find::find()
                    ->where(['category' => $category_name])
                    ->andwhere(['or', ['LIKE', 'title', '%' . $search_category . '%', false,], ['LIKE', 'text', '%' . $search_category . '%', false,]])
                    ->orderBy('id DESC')
                    ->all();

                $session = Yii::$app->session;
                $language = $session->get('language');
                if (!empty($language)) {
                    return $this->render('/site/' . $language . 'find', ["findThing" => $findThing, 'category_name' => $category_name,]);
                } else {
                    return $this->render('/site/am/find', ["findThing" => $findThing, 'category_name' => $category_name,]);
                }
            }
        } else {
            return $this->redirect('/site/error');
        }

    }

}