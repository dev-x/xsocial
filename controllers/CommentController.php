<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;

class CommentController extends Controller
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

    public function actionShow($id=null)
    {
        $comment= Comment::find()->where(['parent_id' => $id])->all();
        return $this->render('show', array('comment' => $comment));
    }
    
    public function actionCreate()
    {
        $model = new Comment();
        if ($model->load($_POST) && !Yii::$app->user->isGuest) {
            $model->parent_type = 0;
            $model->user_id = Yii::$app->user->id;
            $model->created = date("Y-m-d H:i:s");

            if ($model->save()) {
                $res['status'] = 'ok';
                if(Yii::$app->request->isAjax) {
                    $res['data']['username'] = Yii::$app->user->identity->username;
                    $res['data']['userurl'] = Url::toRoute(['user/show', 'username' => Yii::$app->user->identity->username]);
                    $res['data']['avatarurl'] = $model->author->getAvatarUrl();
                    $res['data']['datetime'] =  $model->created;
                    $res['data']['content'] =  $model->content;
                }
            } else $res['status'] = 'error';
        } else $res['status'] = 'error';
        if(Yii::$app->request->isAjax) 
            echo json_encode($res);
        else 
            $this->redirect(array('post/show', 'id'=>$model->parent_id));
    }
    
    public function actionDelete($id,$idP)
    {
        $comment = Comment::findOne($id);
        $comment->delete();
        $this->redirect(array('post/show', 'id'=>$idP));
        //$this->redirect(array('/posts'));
        //$this->loadModel($id)->delete();
        //$this->redirect(array('post/show', 'id'=>$model->parent_id));        
    }
    
}
