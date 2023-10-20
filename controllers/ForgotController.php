<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/1/2018
 * Time: 3:33 PM
 */

namespace app\controllers;


use app\helpers\Mailer;
use app\models\User;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;


class ForgotController extends Controller
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
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionForgot()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model = new \app\models\Forgot;
            $model->setAttributes($post);
            if ($model->validate()) {
                $session = Yii::$app->session;
                $session->open();
                $language = $session->get('language');
                if (empty($language) || $language === 'am/') {
                    $mailLanguage = 'am/';
                    $mailSubject = 'Մոռացե՞լ եք Ձեր գաղտնաբառ:';
                } else {
                    $mailLanguage = 'en/';
                    $mailSubject = 'Forgot password?';
                }
                $url = substr(Url::base(''), 2);
                $forgot_key = Yii::$app->getSecurity()->generateRandomString(16);
                $session->set('forgot_key', $forgot_key);
                $session->set('forgot_email', $post['email']);
                Mailer::createSendEmail('auth/' . $mailLanguage . 'forgot', $post['email'], 'info@rocketsystems.net', $url, $forgot_key, $mailSubject);
                return $this->asJson(['success' => true]);
            } else {
                $error = $model->errors;
                return $this->asJson(['success' => false, "errors" => $error]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionConfirmCode()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model = new \app\models\ConfirmCode;
            $model->setAttributes($post);
            if ($model->validate()) {

                return $this->asJson(['success' => true]);
            } else {
                $error = $model->errors;
                return $this->asJson(['success' => false, "errors" => $error]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionConfirmNewPassword()
    {
        if (Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $model = new \app\models\ConfirmNewPassword;
            $model->setAttributes($post);
            if ($model->validate()) {
                $session = Yii::$app->session;
                $session->open();
                $forgot_email = $session->get('forgot_email');
                $cryptPass = Yii::$app->getSecurity()->generatePasswordHash($post['new_password']);
                $user_data = User::find()->where(['email' => $forgot_email])->one();
                $user_data['password'] = $cryptPass;
                try {
                    $user_data->update();
                } catch (StaleObjectException $e) {
                } catch (\Throwable $e) {
                }
                $session->set('user_id', $user_data['id']);
                $session->set('email', $user_data['email']);
                return $this->asJson(['success' => true]);
            } else {
                $error = $model->errors;
                return $this->asJson(['success' => false, "errors" => $error]);
            }
        } else{
            return $this->asJson(['success' => false]);
        }
    }
}