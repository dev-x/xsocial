<?php

namespace app\controllers;

use Yii;
use yii\helpers\BaseSecurity;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Lists;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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

    public function actionIndex()
    {
        //return $this->render('index');
        return $this->redirect('post/index');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load($_POST) && $model->login()) {
            return $this->goBack();
           // $this->redirect(array('/post/index'));
        } else {
//            echo "-".\yii\helpers\BaseSecurity::generatePasswordHash($model->password)."-";
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm;
        if ($model->load($_POST) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }

    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSignup()
    {
        $list = ArrayHelper::map(Lists::getList('group'), 'id', 'name'); ;
        $model = new User();
        $model->scenario = 'register';
        if ($model->load($_POST)){
            $model->password_hash = \Yii::$app->security->generatePasswordHash($model->password);
                $model->auth_key = 'key';
                if ($model->save()) {
            if (Yii::$app->getUser()->login($model)) {
                return $this->goHome();
            }
        }
    }
        return $this->render('signup', [
            'model' => $model,
            'list' => $list,
        ]);
    }

    public function actionAddvk()
    {
        $code = YII::$app->request->get('code', 0);
        if ($code){
            $url = "https://oauth.vk.com/access_token?client_id=4190651&client_secret=YgonjBxzqn84vuAGbCnS&code={$code}&redirect_uri=".\Yii::$app->getUrlManager()->createAbsoluteUrl('site/addvk');
            $content = file_get_contents($url);
            $data = json_decode($content);
            if ($data->access_token) {
                $user = User::findOne(\Yii::$app->user->id);
                $user->vk_id = $data->user_id;
                $user->save(false); // disabled validation

            }
        }
        $this->redirect(array('user/show', 'username' => Yii::$app->user->identity->username));
    }
}
