<?php

namespace app\controllers;
use yii\web\HttpException;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

use Yii;
use yii\helpers\BaseJson;
use yii\web\Controller;
use app\models\Post;
use app\models\Comment;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

class FeedController extends Controller
{

    public function actionIndex()
    {
        $fts = Yii::$app->user->identity->followingTo;
        
        $ids = '';
        foreach($fts as $ft){
            $ids[] = $ft->following_user_id;
        }
        echo $this->render('/site/feed', [
            'posts' => Post::findAll(['user_id' => $ids])
        ]);
    }
    
}
