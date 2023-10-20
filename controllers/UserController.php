<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 9/18/2018
 * Time: 5:18 PM
 */

namespace app\controllers;


use app\models\Find;
use app\models\Lost;
use app\models\User;
use Yii;
use yii\base\ExitException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @return array
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
     * @throws NotFoundHttpException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $session = Yii::$app->session;
        $user_id = $session->get('user_id');
        if (empty($user_id)) {
            throw new NotFoundHttpException("Page not found.");
        }
        $language = $session->get('language');
        if (!empty($language)) {
            $this->layout = $language . 'main';
        } else {
            $this->layout = 'am/main';
        }
        return parent::beforeAction($action);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $user_id = $session->get('user_id');
        $user = User::find()->where(['id' => $user_id])->one();
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'user', ['user' => $user]);
        } else {
            return $this->render('am/user', ['user' => $user]);
        }
    }

    /**
     * @return string
     */
    public function actionMyItems()
    {
        $session = Yii::$app->session;
        $user_id = $session->get('user_id');
        if (!empty($user_id)) {
            $session = Yii::$app->session;
            $user_id = $session->get('user_id');
            $myLostItems = Lost::find()->with('lostImages')->where(['user_id' => $user_id])->orderBy('id DESC')->all();
            $myFindItems = Find::find()->with('findImages')->where(['user_id' => $user_id])->orderBy('id DESC')->all();
            $session = Yii::$app->session;
            $language = $session->get('language');
            if (!empty($language)) {
                return $this->render($language . 'myitems', ["myLostItems" => $myLostItems, 'myFindItems' => $myFindItems]);
            } else {
                return $this->render('am/myitems', ["myLostItems" => $myLostItems, 'myFindItems' => $myFindItems]);
            }
        } else {
            return $this->redirect('index');
        }
    }
}