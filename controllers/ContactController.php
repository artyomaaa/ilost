<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 9/21/2018
 * Time: 1:52 PM
 */

namespace app\controllers;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\helpers\Mailer;


class ContactController extends Controller
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
     * @return string
     *
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'contact');
        } else {
            return $this->render('am/contact');
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionContactUs()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $url = substr(Url::base(''), 2);
            $session = Yii::$app->session;
            $language = $session->get('language');
            if (empty($language)) {
                $mailLanguage = 'am/';
                $mailSubject = "Դուք ունեք նամակ " . $post["contact_name"] . " ից";
            } elseif (!empty($language) && $language === 'am/') {
                $mailLanguage = 'am/';
                $mailSubject = "Դուք ունեք նամակ " . $post["contact_name"] . " ից";
            } else {
                $mailLanguage = 'en/';
                $mailSubject = "You have a message from " . $post["contact_name"];
            }
            Mailer::createSendEmail('contact/' . $mailLanguage . 'contactUs.php', 'info@rocketsystems.net', 'info@rocketsystems.net', $url, $post, $mailSubject,$post['contact_email']);
            return $this->asJson(['success' => true,]);
        } else {
            return $this->asJson(['success' => false,]);
        }
    }

    /**
     * @return \yii\web\Response
     * Contatc to user
     */
    public function actionContactUser()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $url = substr(Url::base(''), 2);
            $session = Yii::$app->session;
            $language = $session->get('language');
            if (empty($language)) {
                $mailLanguage = 'am/';
                $mailSubject = "Դուք կորցրել, կամ ինչ-որ բան եք՞ գտել ";
            } elseif (!empty($language) && $language === 'am/') {
                $mailLanguage = 'am/';
                $mailSubject = "Դուք կորցրել, կամ ինչ-որ բան եք՞ գտել ";
            } else {
                $mailLanguage = 'en/';
                $mailSubject = "Have you lost or found something?";
            }
            Mailer::createSendEmail('contact/' . $mailLanguage . 'contactUser.php', $post['user_email'], "info@rocketsystems.net", $url, $post, $mailSubject,$post['send_email']);
            return $this->asJson(['success' => true,]);
        } else {
            return $this->asJson(['success' => false,]);
        }
    }
}