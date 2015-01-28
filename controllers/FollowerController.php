<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Image;
use app\models\Post;
use app\models\Follower;
use yii\data\ActiveDataProvider;

class FollowerController extends Controller
{
    public function actionCreate()
    {
        
        $user_id = (int)Yii::$app->user->id;
        $follower_user_id = (int)$_POST['id'];
        
        $follower = Follower::findOne([
            'user_id' => $user_id,
            'following_user_id' => $follower_user_id,
        ]);
        
        if(!$follower){
            $follower = new Follower;
            $follower->user_id = $user_id;
            $follower->following_user_id = $follower_user_id;
            $follower->save();
            
            return \yii\helpers\Json::encode(Array('status' => 'created'));
        } else {
            return \yii\helpers\Json::encode(Array('status' => 'none'));
        }
    }
    
    public function actionDelete()
    {
        $user_id = (int)Yii::$app->user->id;
        $follower_user_id = (int)$_POST['id'];
        
        $follower = Follower::findOne([
            'user_id' => $user_id,
            'following_user_id' => $follower_user_id,
        ]);
        if($follower){
            $follower->delete();
            return \yii\helpers\Json::encode(Array('status' => 'deleted'));
        } else   
            return \yii\helpers\Json::encode(Array('status' => 'none'));
    }
}
