<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['logout', 'index'],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $log = User::find()->where(['email' => $model->email, 'is_block' => 0])->one();
            \Yii::$app->session->set('uid', $log->user_id);
            \Yii::$app->session->set('fio', $log->fio);
            \Yii::$app->session->set('username', $log->username);
            \Yii::$app->session->set('email', $log->email);
            \Yii::$app->session->set('user_type', $log->user_type);
            \Yii::$app->session->set('photo', $log->photo);

            return $this->redirect('/product');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->remove('uid');
        Yii::$app->session->remove('username');
        Yii::$app->session->remove('email');
        Yii::$app->session->remove('user_type');
        Yii::$app->session->remove('photos');
        return $this->redirect('/site/login');
    }
}
