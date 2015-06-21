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
use app\models\Lists;
use yii\helpers\Html;
use yii\helpers\Url;

class SearchController extends Controller
{
	
    public function actionIndex()
    {
        echo "xxxx";
    }
    
    public function actionTaxonomy($taxonomy, $keyword = null)
    {
       // echo "{$taxonomy} : {$keyword}";
         $model = '';
		switch ($taxonomy){
			case 'hashtag':
				$posts = Post::find()->where(['like','content', '#'.$keyword]);
                                $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
				break;
			case 'feed':
                           	if (Yii::$app->user->isGuest) {
					return $this->redirect('site/login');
				}
				$fts = Yii::$app->user->identity->followingTo;
        
				$ids = '';
				foreach($fts as $ft){
					$ids[] = $ft->following_user_id;
				}
				
                                $posts = Post::find()->where(['user_id' => $ids])->andWhere('privacy_id >=43');
                                $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
                                
				break;
                        case 'post_type':
                        case 'post_category':
                                    $lists = Lists::findOne(array('list_type' => $taxonomy, 'slug' => $keyword));
                                    $posts = Post::find()->where([$taxonomy => $lists->id])->orderBy(' `post_time` DESC');
                                    $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
                            break;
                        
                        case 'institute':
                            if (Yii::$app->user->isGuest) {
					echo 'redirect login'; 
					return;
				}
                            $id_group = Lists::find()->where(['id' => Yii::$app->user->identity->group])->one();
                            $id_department = Lists::find()->where(['id' => $id_group->parent_id])->one();
                            //var_dump($id_department->parent_id);exit;
                            
                            $model_department = Lists::find()->where(['list_type'=>'department','parent_id' => $id_department->parent_id])->all();
                            $department_id = '';
                                foreach($model_department as $department){
                                    $department_id[] = $department->id;
                                }
                            
                            $model_groups = Lists::find()->where(['list_type'=>'group','parent_id' => $department_id])->all();
                            //var_dump($model_groups);exit;
                            
                            $group_id = '';
                                foreach($model_groups as $group){
                                    $group_id[] = $group->id;
                                }
                                
                            $model_users = User::find()->where(['group' => $group_id])->all();
                            $user_id = '';
                                foreach($model_users as $user){
                                    $user_id[] = $user->id;
                                }
                            //var_dump($user_id);exit;
                            
                            $posts = Post::find()->where(['user_id' => $user_id])->andWhere('privacy_id >= 45')->orderBy(' `post_time` DESC');
                            $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);                          
                            break;
                        
                        case 'department':
                            if (Yii::$app->user->isGuest) {
					echo 'redirect login'; 
					return;
				}
                            $id_department = Lists::find()->where(['id' => Yii::$app->user->identity->group])->one();
                            $model_groups = Lists::find()->where(['list_type'=>'group','parent_id' => $id_department->parent_id])->all();
                            $group_id = '';
                                foreach($model_groups as $group){
                                    $group_id[] = $group->id;
                                }
                            $model_users = User::find()->where(['group' => $group_id])->all();
                            
                            $user_id = '';
                                foreach($model_users as $user){
                                    $user_id[] = $user->id;
                                }
                            //var_dump($users);exit;
                            
                            $posts = Post::find()->where(['user_id' => $user_id])->andWhere('privacy_id >= 44')->orderBy(' `post_time` DESC');
                            $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);                         
                            break;
                            
                            
                        case 'group':
                            if (Yii::$app->user->isGuest) {
                                echo 'redirect login'; 
                                return;
                            }
                            $model_users = User::find()->where(['group' => Yii::$app->user->identity->group])->all();
                            $user_id = '';
                                foreach($model_users as $user){
                                    $user_id[] = $user->id;
                                }
                            $posts = Post::find()->where(['user_id' => $user_id])->andWhere('privacy_id >= 43')->orWhere('privacy_id > 44')->orderBy(' `post_time` DESC');
                            $model = new ActiveDataProvider(['query' => $posts, 'pagination' => ['pageSize' => 5]]);
                            
                        } echo $this->render('/site/feed', [
                            'posts' => $model->getModels(),
                            'pagination' => $model->pagination,
                            'count' => $model->pagination->totalCount,
                    ]);
    }
}
