<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Image;
use app\models\Post;
use app\models\Follower;
use yii\data\ActiveDataProvider;

class UserController extends Controller
{
    public function actions()
    {
        return array(
            'error' => array(
                'class' => 'yii\web\ErrorAction',
            ),
            'captcha' => array(
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ),
        );
    }

    public function actionIndex() {
        /*($users = User::find()->all();
        return $this->render('index', ['users' => $users]);*/
        $active = 1;
        $query = User::find()->where(array('dozvil' => $active));
        $model = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>isset($_GET['pageSize'])?$_GET['pageSize']:6]]);
        echo $this->render('index', [
            'users'=>$model->getModels(),
            'pagination'=>$model->pagination,
            'count'=>$model->pagination->totalCount
        ]);
    }

    public function actionShow($username=null)
    {
        $user = User::findByUsername($username);

        if ($user) {}
        $image = new Image();

        //$images = $user->getUserImages();
        $post = null;
        if (!Yii::$app->user->isGuest && (Yii::$app->user->id == $user->id) && ($user->dozvil == 1)) {
            $post = Post::findOne(array('user_id' => $user->id, 'status' => 'draft'));
        }
        if (!$post)
            $post = new Post();
        
        

        return $this->render('show', ['modelUser' => $user, 'modelImage' => $image, 'modelNewPost' => $post]);
    }

    public function actionImages($username=null)
    {
        $user = User::findByUsername($username);
        $image = new Image();

        return $this->render('images', ['modelUser' => $user, 'modelImage' => $image]);
    }

    public function actionProfile($username=null)
    {
        $user = User::findByUsername($username);
        $image = new Image();

        return $this->render('profile', ['modelUser' => $user, 'modelImage' => $image]);
    }
    
    public function actionMyfollows($username=null)
    {
        $user = User::findByUsername($username);
        
        $followerModel = Follower::findAll(['user_id' => $user->id]);
        $id_user = '';
        foreach($followerModel as $follower){
            $id_user[] = $follower->following_user_id;
        }
        $FollowUser = User::findAll(['id' => $id_user]);
        
        $image = new Image();
        return $this->render('myfollows', ['modelUser' => $user, 'modelImage' => $image, 'followUser' => $FollowUser]);
    }
    
    public function actionEdit($id)
    {
        if($model = User::findOne($id)){
            $model->scenario = 'profile';
                if ($model->load($_POST)) {
                    if ($model->save()){
                        $this->redirect(array('user/profile', 'username'=>$model->username));
                    }
                }else{
                    echo $this->render('edit', array('model' => $model));
            }
        }
        
    }

    public function actionPosts($username=null)
    {
        $user = User::findByUsername($username);
        $image = new Image();

        return $this->render('posts', ['modelUser' => $user, 'modelImage' => $image]);
    }

}
