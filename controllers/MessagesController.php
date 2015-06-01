<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Messages;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Image;
use app\models\Post;
use app\models\Likes;
use app\models\Lists;
use app\models\Follower;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class MessagesController extends Controller
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

    public function actionIndex($username,$request=null)
    {
        $users = User::find()->all();
        $friend = User::find()->where(['username' => $request])->one();
        $query = Messages::find()->where(['user_id' => Yii::$app->user->identity->id, 'friend_id' => $friend['id']])->orWhere(['user_id' => $friend['id'], 'friend_id' => Yii::$app->user->identity->id])->orderBy(' `created` DESC');
        $model = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);

        $modelNewMessage = new Messages;
        $user = User::findByUsername($username);
        
        $image = new Image();
        echo $this->render('../user/mymessagesdialog', [
            'modelNewMessage' => $modelNewMessage,
            'modelUser' => $user,
            'modelFriend' => $friend,
            'modelImage' => $image,
            'messages' => $model->getModels(), 
            'pagination' => $model->pagination
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Messages();
        
        if ($model->load($_POST) && !Yii::$app->user->isGuest) {
            $model->content = $_POST['Messages']['content'];
            $model->created = date("Y-m-d H:i:s");
            $model->stanRead = '1';

            if($model->save()) {
                $res['status'] = 'ok';
                if(Yii::$app->request->isAjax) {
                    $res['data']['user_id'] = $model->user_id;
                    $res['data']['friend_id'] =  $model->friend_id;
                    $res['data']['content'] = $model->content;
                    $res['data']['created'] =  $model->created;
                    $message = Messages::find()->where(['user_id' => $model->user_id, 'friend_id' => $model->friend_id, 'created' => $model->created])->one();
                    $user_created = User::find()->where(['id' => $model->user_id])->one();
                    
                    $res['data']['id'] = $message['id'];
                    $res['data']['avatar'] = $user_created['avatar'];
                }
            } else $res['status'] = 'error2';
        } else $res['status'] = 'error1';
           // if(Yii::$app->request->isAjax) 
            echo json_encode($res);
        //else */
          //  $this->redirect(array('post/show', 'id'=>$model->parent_id));
    }   
        
    public function actionDelete()
    {   
        $message = Messages::findOne($_POST['id']);
        if($message->delete()){
            $res = 'good';
        }else{
            $res = 'bad';
        }
            
        echo json_encode($res);
        //$this->redirect(array('post/show', 'id'=>$idP));
        //$this->redirect(array('/posts'));
        //$this->loadModel($id)->delete();
        //$this->redirect(array('post/show', 'id'=>$model->parent_id));        
    }
    
}
