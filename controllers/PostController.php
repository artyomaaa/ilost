<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 9/18/2018
 * Time: 5:35 PM
 */

namespace app\controllers;

use app\helpers\Pagination;
use app\helpers\Search;
use app\helpers\UploadImage;
use app\models\Post;
use app\models\UploadForm;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\Response;
use app\models\Lost;
use app\models\Find;
use app\models\LostImage;
use app\models\FindImage;
use app\components\Helper as Helper;

class PostController extends Controller
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
     * @return Response
     * @throws StaleObjectException
     * @throws \Throwable
     * @throws \yii\base\Exception
     */

    public function actionStatementSave()
    {
        if (Yii::$app->request->post()) {
            $model = new \app\models\Statement();
            $post = Yii::$app->request->post();
            $model->setAttributes($post);
            $session = Yii::$app->session;
            $user_id = $session->get('user_id');
            if ($model->validate()) {
                $contact = $post["contact"];
                $img_kod = Helper::generateRandomString(15);
                if (empty($post['edit-id'])) {
                    Post::createStatement($contact, $post, $user_id, $img_kod);
                } else {
                    $id = $post["edit-id"];
                    Post::createStatementUpdate($contact, $post, $id, $img_kod);
                    $session->open();
                    $session->set('edit', "");
                }
                if (!empty($post['image_data_array'])) {
                    UploadImage::getFile($post, $img_kod);
                }
                return $this->asJson(['success' => true, ['contact' => $contact]]);
            } else {
                $errors = $model->errors;
                return $this->asJson(['success' => false, ['errors' => $errors]]);
            }
        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @return Response
     */
    public function actionCancel()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            if (!empty($post['cancel'])) {
                $session = Yii::$app->session;
                $session->open();
                $session->set('edit', "");
            }
            return $this->asJson(['success' => true]);

        } else {
            return $this->asJson(['success' => false]);
        }
    }

    /**
     * @param $id
     * @param $contact
     * @return Response
     */
    public function actionDeleteLost($id, $contact)
    {
        $session = Yii::$app->session;
        $user_id = $session->get('user_id');
        if (!empty($user_id)) {
            if (!empty($contact) && $contact === 'lost') {
                $myItems = Lost::find()->with('lostImages')->where(['id' => $id])->one();
                try {
                    $myItems->delete();
                } catch (StaleObjectException $e) {
                } catch (\Throwable $e) {
                }
                return $this->redirect('/user/my-items');
            } else {
                $myItems = Find::find()->with('findImages')->where(['id' => $id])->one();
                try {
                    $myItems->delete();
                } catch (StaleObjectException $e) {
                } catch (\Throwable $e) {
                }
                return $this->redirect('/user/my-items');
            }

        } else {
            return $this->redirect('/user/my-items');
        }
    }

    /**
     * @return Response
     */
    public function actionDeleteImages()
    {
        $session = Yii::$app->session;
        $user_id = $session->get('user_id');
        if (!empty($user_id)) {
            if (Yii::$app->request->post()) {
                $post = Yii::$app->request->post();
                if ($post['image_contact'] === 'lost') {
                    $image_name = $post['image_name'];
                    if (is_file('uploads/' . $image_name)) {
                        unlink('uploads/' . $image_name);
                    }
                    $images = LostImage::find()->where(['image' => $image_name])->one();
                    try {
                        $images->delete();
                    } catch (StaleObjectException $e) {
                    } catch (\Throwable $e) {
                    }
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('edit', "");
                    $edit = Lost::find()->with('lostImages')->where(['id' => $post['edit_id']])->one();
                    $session->set('edit', $edit);
                    return $this->asJson(['success' => true]);
                } else {
                    $image_name = $post['image_name'];
                    if (is_file('uploads/' . $image_name)) {
                        unlink('uploads/' . $image_name);
                    }
                    $images = FindImage::find()->where(['image' => $image_name])->one();
                    try {
                        $images->delete();
                    } catch (StaleObjectException $e) {
                    } catch (\Throwable $e) {
                    }
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('edit', "");
                    $edit = Find::find()->with('findImages')->where(['id' => $post['edit_id']])->one();
                    $session->set('edit', $edit);
                    return $this->asJson(['success' => true]);
                }
            } else {
                return $this->asJson(['success' => false]);
            }
        } else {
            return $this->redirect('/site/index');
        }
    }

    /**
     * @param $id
     * @param $contact
     * @return Response
     */
    public function actionEdit($id, $contact)
    {
        $session = Yii::$app->session;
        $user_id = $session->get('user_id');
        if (!empty($user_id)) {
            if (!empty($contact) && $contact === 'lost') {
                $edit = Lost::find()->with('lostImages')->where(['id' => $id])->one();
                $session->open();
                $session->set('edit', $edit);
                return $this->redirect('/site/index');
            } else {
                $edit = Find::find()->with('findImages')->where(['id' => $id])->one();
                $session->open();
                $session->set('edit', $edit);
                return $this->redirect('/site/index');
            }
        } else {
            return $this->redirect('/user/my-items');
        }
    }

    /**
     * @return Response
     */
    public function actionSearch()
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $search = Search::Search($post[0]);
            $search_translated = Search::Search($post[1]);
            $findin = array_merge($search, $search_translated);
            $session = Yii::$app->session;
            $session->open();
            $session->set('findin', $findin);
            return $this->asJson(['success' => true]);
        } else {
            return $this->asJson(['success' => false]);
        }
    }


}