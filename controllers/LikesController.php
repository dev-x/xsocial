<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Image;
use app\models\Post;
use app\models\Likes;
use app\models\Follower;
use yii\data\ActiveDataProvider;

class LikesController extends Controller
{
    
    public function actionCreate()
    {   
        $user_id = (int)Yii::$app->user->id;
        $parent_id = (int)$_POST['id'];
        $parent_type = $_POST['type'];
        
        $likes = Likes::findOne([
            'user_id' => $user_id,
            'parent_id' => $parent_id,
            'parent_type' => $parent_type,
        ]);
        
        if($parent_type == 'Post'){
            $model = Post::findOne(['id' => $parent_id]);   
        }
        if($parent_type == 'Image'){
            //find image   
        }
        
        if(!$likes){
            $likes = new Likes;
            $likes->user_id = $user_id;
            $likes->parent_id = $parent_id;
            $likes->parent_type = $parent_type;
            $likes->save();
            
            $model->likes = $model->likes + 1;
            $model->save();
            
            return \yii\helpers\Json::encode(Array('status' => 'created', 'likesCount' => $model->likes, 'modelid' => $model->id));
        } else {
            return \yii\helpers\Json::encode(Array('status' => 'none', 'likesCount' => $model->likes));
        }
    }
    
    public function actionDelete()
    {
        $user_id = (int)Yii::$app->user->id;
        $parent_id = (int)$_POST['id'];
        $parent_type = $_POST['type'];
        
        $likes = Likes::findOne([
            'user_id' => $user_id,
            'parent_id' => $parent_id,
            'parent_type' => $parent_type,
        ]);
        
        if($parent_type == 'Post'){
            $model = Post::findOne(['id' => $parent_id]);   
        }
        
        if($likes){
            $likes->delete();
            
            $model->likes = (int)$model->likes - 1;
            $model->save();
            
            return \yii\helpers\Json::encode(Array('status' => 'deleted', 'likesCount' => $model->likes, 'modelid' => $model->id));
        } else   
            return \yii\helpers\Json::encode(Array('status' => 'none'));
    }
    
}