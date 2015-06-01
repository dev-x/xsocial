<?php

namespace app\controllers;
use yii\data\Pagination;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Image;
use app\models\Post;
use app\models\Likes;
use app\models\Lists;
use app\models\Follower;
use app\models\Messages;
use yii\helpers\ArrayHelper;

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
        $list = ArrayHelper::map(Lists::getList('post_type'), 'id', 'name'); ;
        $list_private = ArrayHelper::map(Lists::getList('privacy_post'), 'id', 'name'); ;

        return $this->render('show', ['modelUser' => $user, 'modelImage' => $image, 'modelNewPost' => $post, 'list' => $list, 'list_private' => $list_private]);
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
    
    public function actionMylikes($username=null)
    {
        $user = User::findByUsername($username);
        
        $likeModel = Likes::findAll(['user_id' => $user->id]);
        $id_model = '';
        foreach($likeModel as $like){
            //$id_model[$like->parent_type][] = $like->parent_id;
            $id_model[] = $like->parent_id;
        }
        $query = Post::find()->where(['id' => $id_model]);
        $model = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 5]]);
        
        $image = new Image();
        return $this->render('mylikes', ['modelUser' => $user, 'modelImage' => $image, 'likepost' => $model->getModels(), 'pagination' => $model->pagination]);
    }

    public function actionMessages($username=null)
    {
        $messages = Messages::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(' `created` ASC')->all();        
        $messages2 = Messages::find()->where(['friend_id' => Yii::$app->user->identity->id])->orderBy(' `created` ASC')->all();        
        
        $list_user_friend = ArrayHelper::map($messages, 'created', 'content', 'friend_id');
        $list_user_friend2 = ArrayHelper::map($messages2, 'created', 'content', 'user_id');
        
        $last_message_sort = \app\lib\Message::messageLastSort($list_user_friend, $list_user_friend2);
        
        $user = User::findByUsername($username);
        
        $image = new Image();
        return $this->render('mymessages', ['modelUser' => $user, 'modelImage' => $image, 'mymessages' => $last_message_sort]); 
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
                    $list = ArrayHelper::map(Lists::getList('group'), 'id', 'name');
                    $list_city = ArrayHelper::map(Lists::getList('city'), 'id', 'name');
                    
                    echo $this->render('edit', array('model' => $model, 'list' => $list, 'list_city' => $list_city));
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
