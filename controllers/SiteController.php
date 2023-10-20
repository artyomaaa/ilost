<?php

namespace app\controllers;

use app\helpers\Pagination;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Lost;
use app\models\Find;
use app\models\User;
use app\components\Helper as Helper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];

    }

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $statements = Lost::getLosts(6);
        $findThing = Find::getFinds(6);
        $session = Yii::$app->session;
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'index', ['statements' => $statements, 'findThing' => $findThing]);
        } else {
            return $this->render('am/index', ['statements' => $statements, 'findThing' => $findThing]);
        }
    }

    /**
     * @param $id
     * @param $category
     * @return string
     */
    public function actionAboutItem($id, $category)
    {
        if (!empty($category) && $category === 'lost') {
            $one_statement = Lost::find()->with('lostImages')->where(["id" => $id])->one();
            $count = count($one_statement['lostImages']);
            $mass = '';
        } else {
            $one_statement = Find::find()->with('findImages')->where(["id" => $id])->one();
            $count = count($one_statement['findImages']);
            $mass = Helper::generateRandomString(8);
        }
        $session = Yii::$app->session;
        $user = User::find()->where(['id' => $one_statement->user_id])->one();
        $user_id = $session->get('user_id');
        $contact_to_user = User::find()->where(['id' => $user_id])->one();
        $this->view->params['customParam'] = $one_statement;
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'about', ['one_statement' => $one_statement, 'user' => $user, 'count' => $count, 'mass' => $mass, 'contact_to_user' => $contact_to_user]);
        } else {
            return $this->render('am/about', ['one_statement' => $one_statement, 'user' => $user, 'count' => $count, 'mass' => $mass, 'contact_to_user' => $contact_to_user]);
        }
    }

    /**
     * Displays lost page.
     *
     * @return string
     */
    public function actionLost()
    {
        $session = Yii::$app->session;
        $language = $session->get('language');
        $lostThing = Lost::find()->orderBy('id DESC')->all();
        $provider = Pagination::Pagination($lostThing);
        $lostThing = $provider->getModels();
        if (!empty($language)) {
            return $this->render($language . 'lost', ["lostThing" => $lostThing, 'provider' => $provider]);
        } else {
            return $this->render('am/lost', ["lostThing" => $lostThing, 'provider' => $provider]);
        }
    }

    /**
     * @return string
     */
    public function actionFind()
    {
        $findThing = Find::find()->orderBy('id DESC')->all();
        $provider = Pagination::Pagination($findThing);
        $findThing = $provider->getModels();
        $session = Yii::$app->session;
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'find', ["findThing" => $findThing, 'provider' => $provider]);
        } else {
            return $this->render('am/find', ["findThing" => $findThing, 'provider' => $provider]);
        }
    }

    /**
     * @return Response
     */
    public function actionLanguage()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            if ($post['language'] === 'english') {
                $session = Yii::$app->session;
                $session->open();
                $session->set('language', 'en/');
                return $this->asJson(['success' => true]);
            } else {
                $session = Yii::$app->session;
                $session->open();
                $session->set('language', 'am/');
                return $this->asJson(['success' => true]);
            }

        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return string
     */
    public function actionPrivacyPolicy()
    {
        $session = Yii::$app->session;
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'privacy_policy');
        } else {
            return $this->render('am/privacy_policy');
        }
    }

    /**
     * @return string
     */
    public function actionSearch()
    {
        $session = Yii::$app->session;
        $findin = $session->get('findin');
        $provider = Pagination::Pagination($findin);
        $findin = $provider->getModels();
        $language = $session->get('language');
        if (!empty($language)) {
            return $this->render($language . 'lost', ["lostThing" => $findin, 'provider' => $provider]);
        } else {
            return $this->render('am/lost', ["lostThing" => $findin, 'provider' => $provider]);
        }
    }
}
