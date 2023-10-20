<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 9/19/2018
 * Time: 8:31 PM
 */

namespace app\controllers;

use app\helpers\Mailer;
use app\helpers\UserUpdate;
use app\models\User;
use Yii;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use app\components\Helper as Helper;


class AuthController extends Controller
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

    public function actionSignUp()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model = new \app\models\ContactForm;
            $model->setAttributes($post);
            if ($model->validate()) {
                $token = Helper::generateRandomString(14);
                $cryptPass = Yii::$app->getSecurity()->generatePasswordHash($post['password']);
                $user = new User([
                    'first_name' => $post['first_name'],
                    'last_name' => $post['last_name'],
                    'email' => $post['email'],
                    'contact_number' => $post['contact_number'],
                    'password' => $cryptPass,
                    'verify' => 0,
                    'token' => $token,
                ]);
                $user->save();
                $url = substr(Url::base(''), 2);
                $session = Yii::$app->session;
                $language = $session->get('language');
                if (empty($language)) {
                    $mailLanguage = 'am/';
                    $mailSubject = 'Հաստատեք ձեր էլ.հասցեն';
                } elseif (!empty($language) && $language === 'am/') {
                    $mailLanguage = 'am/';
                    $mailSubject = 'Հաստատեք ձեր էլ.հասցեն';
                } else {
                    $mailLanguage = 'en/';
                    $mailSubject = 'Confirm your email on iLost';
                }
                Mailer::createSendEmail('auth/' . $mailLanguage . 'mailer.php', $post['email'], 'info@rocketsystems.net', $url, $token, $mailSubject);
                $this->view->params['verify_modal'] = 'open';
                return $this->asJson(['success' => true,]);
            } else {
                $errors = $model->errors;
                return $this->asJson(['success' => false, 'errors' => $errors]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return \yii\web\Response
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionGetEmail()
    {
        $get = Yii::$app->request->get();
        $token = $get['token'];
        if (!empty($get['email'])) {
            $email = $get['email'];
        }
        try {
            $user_data = User::find()->where(['token' => $token])->one();
            if (!empty($user_data)) {
                if (empty($email)) {
                    $user_data->verify = 1;
                    $user_data->update();
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('user_id', $user_data->id);
                    $session->set('email', $user_data->email);
                    return $this->redirect('/site/index');
                } else {
                    $user_data->email = $email;
                    $user_data->update();
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('user_id', $user_data->id);
                    $session->set('email', $email);
                    return $this->redirect('/user/user');
                }

            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $this->redirect('/site/index');

    }

    /**
     * @return \yii\web\Response
     */

    public function actionSignIn()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model = new \app\models\LoginForm();
            $model->setAttributes($post);
            if ($model->validate()) {
                    return $this->asJson(['success' => true]);
            } else {
                $errors = $model->errors;
                return $this->asJson(['success' => false, 'errors' => $errors]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogOut()
    {

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            if (!empty($post['data'])) {
                $session = Yii::$app->session;
                $session->open();
                $session->set('user_id', '');
                $session->set('password', '');
                $session->set('email', '');
                return $this->asJson(['success' => true]);
            } else {
                return $this->asJson(['success' => false]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     * @throws \Throwable
     */
    public function actionChangeUserData()
    {
        if (Yii::$app->request->post()) {
            $session = Yii::$app->session;
            $session->open();
            $email = $session->get('email');
            $post = Yii::$app->request->post();
            $model = new \app\models\ChangeForm;
            $model->new_password = $post['new_password'];
            $model->setAttributes($post);
            if ($model->validate()) {
                UserUpdate::getUserUpdate($post);
                $send_email = false;
                if ($email !== $post['email']) {
                    $language = $session->get('language');
                    if (empty($language) || $language === 'am/') {
                        $mailLanguage = 'am/';
                        $mailSubject = 'Հաստատեք ձեր էլ.հասցեի փոփոխությունը';
                    } else {
                        $mailLanguage = 'en/';
                        $mailSubject = 'Confirm your email address change';
                    }
                    $user_data = User::find()->where(['email' => $email])->one();
                    $key = $user_data->token;
                    $email_data = array(['token' => $key, 'email' => $post['email']]);
                    $url = substr(Url::base(''), 2);
                    Mailer::createSendEmail('auth/' . $mailLanguage . 'changeFile', $post['email'], 'info@rocketsystems.net', $url, $email_data, $mailSubject);
                    $send_email = true;
                }
                return $this->asJson(['success' => true, 'send_email' => $send_email]);
            } else {
                $errors = $model->errors;
                return $this->asJson(['success' => false, 'errors' => $errors]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

}