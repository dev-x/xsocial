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
use yii\helpers\Url;

use yii\data\ActiveDataProvider;

class AdminController extends Controller
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
        if (Yii::$app->user->id != 1) {
            return $this->redirect('/site');	
        }
        $active = 0;
        $group = ArrayHelper::map(Lists::getList('group'), 'id', 'name');
        $kafedra = ArrayHelper::map(Lists::getList('department'), 'id', 'name');
        $query = User::find()->where(array('active' => $active));
        $model = new ActiveDataProvider(['query'=>$query,'pagination'=>['pageSize'=>isset($_GET['pageSize'])?$_GET['pageSize']:6]]);
        
        echo $this->render('index', [
            'users'=>$model->getModels(),
            'pagination'=>$model->pagination,
            'count'=>$model->pagination->totalCount,
            'group'=>$group,
            'kafedra'=>$kafedra
        ]);
    }
    
    public function actionAddkafedra() {
        $modelNewDepartment = new Lists();
        //$groupModel = Lists::find()->where(['list_type' => 'department'])->all();
        $modelInst = Lists::find()->where(['list_type' => 'institute'])->all();
        $listInst = ArrayHelper::map(Lists::getList('institute'), 'id', 'name');
        
        $query = Lists::find()->where(['list_type' => 'department'])->orderBy(' `id` DESC');
        $modelDepartment = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
        
        if($modelNewDepartment->load($_POST)) {
            //print_r($modelNewGroup);exit;
            //print_r($modelNewGroup->name);exit;
            $modelNewDepartment->list_type = 'department';
            if ($modelNewDepartment->save()){
               $modelNewDepartment = new Lists();
            }else{
                echo $this->render('add_department',[]);
            }
        }
        
            echo $this->render('add_department',[
                'departments' => $modelDepartment->getModels(),
                'pagination' => $modelDepartment->pagination,
                'group' => $groupModel,
                'institutes' => $modelInst,
                'newdepartment' => $modelNewDepartment,
                'listKafedra' => $listInst
            ]);
        
    }
    
    public function actionDeletekafedra($id)
    {   
        $kafedra = Lists::findOne($id);
        if($kafedra->delete()){
            $this->redirect(array('admin/addkafedra'));
        }else{
            $this->redirect(array('admin/addkafedra'));
        }
    }
    
    public function actionAddgroup() {
        $modelNewGroup = new Lists();
        //$groupModel = Lists::find()->where(['list_type' => 'group'])->all();
        $groupInst = Lists::find()->where(['list_type' => 'institute'])->all();
        $modelKafedra = Lists::find()->where(['list_type' => 'department'])->all();
        $listKafedra = ArrayHelper::map(Lists::getList('department'), 'id', 'name');
        
        $query = Lists::find()->where(['list_type' => 'group'])->orderBy(' `id` DESC');
        $modelGroup = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
        
        if($modelNewGroup->load($_POST)) {
            $modelNewGroup->list_type = 'group';
            if ($modelNewGroup->save()){
               $modelNewGroup = new Lists();
            }else{
                $modelNewGroup = new Lists();
            }
        }
        echo $this->render('add_group',[
            'groups' => $modelGroup->getModels(),
            'pagination' => $modelGroup->pagination,
            'modelKafedra' => $modelKafedra,
            'institute' => $groupInst,
            'newgroup' => $modelNewGroup,
            'listKafedra' => $listKafedra
        ]);
        
    }
    
    public function actionAddinstitute() {
        $modelNewInstitute = new Lists();
        
        $modelInst = Lists::find()->where(['list_type' => 'institute'])->all();
        $modelKafedra = Lists::find()->where(['list_type' => 'department'])->all();
        $listKafedra = ArrayHelper::map(Lists::getList('department'), 'id', 'name');
        
        $query = Lists::find()->where(['list_type' => 'institute'])->orderBy(' `id` DESC');
        $modelInstitute = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
        
        if($modelNewInstitute->load($_POST)) {
            $modelNewInstitute->list_type = 'institute';
            if ($modelNewInstitute->save()){
                $modelNewInstitute = new Lists();
            }else{
                $modelNewInstitute = new Lists();
            }
        }
        echo $this->render('add_institute',[
            'modelInstitute' => $modelInstitute->getModels(),
            'pagination' => $modelInstitute->pagination,
            'modelKafedra' => $modelKafedra,
            'institute' => $modelInst,
            'newinstitute' => $modelNewInstitute,
            'listKafedra' => $listKafedra
        ]);
        
    }
    
    public function actionDeleteinstitute($id)
    {   
        $institute = Lists::findOne($id);
        if($institute->delete()){
            $this->redirect(array('admin/addinstitute'));
        }else{
            $this->redirect(array('admin/addinstitute'));
        }
    }
    
    public function actionDeletegroup($id)
    {   
        $group = Lists::findOne($id);
        if($group->delete()){
            $this->redirect(array('admin/addgroup'));
        }else{
            $this->redirect(array('admin/addgroup'));
        }
    }
    
    public function actionActivated() {
        $id = $_POST['id'];
        $res = array();
        if($model = User::findOne(['id' => $id])){
            $model->scenario = 'activeted';
            $model->active = 1;
            $model->dozvil = 1;
            $model->save();
            $res['status'] = 'good';
            $res['text'] = 'Відмовити';
        }else{
           $res['status'] = 'error';
           $res['text'] = 'Підтвердити';
        } 
        echo json_encode($res); 
    }
    
    public function actionDisabling() {
        $id = $_POST['id'];
        $res = array();
        if($model = User::findOne(['id' => $id])){
            $model->scenario = 'activeted';
            $model->active = 0;
            $model->dozvil = 0;
            $model->save();
            $res['status'] = 'good';
            $res['text'] = 'Підтвердити';
        }else{
           $res['status'] = 'error';
           $res['text'] = 'Відмовити';
        } 
        echo json_encode($res);
    }
    
}
