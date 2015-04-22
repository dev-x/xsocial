<?php

namespace app\models;

class Post extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'post';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'ВАШ КОНЕНТ',
            'post_time' => 'post_time',
            );
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord)
        {
            $this->user_id = \Yii::$app->user->id;
            $this->post_time = date("Y-m-d H:i:s");
//            $this->created = new Expression('NOW()');
//            $command = static::getDb()->createCommand("select max(id) as id from posts")->queryAll();
//            $this->id = $command[0]['id'] + 1;
        }

//        $this->updated = new Expression('NOW()');
        return parent::beforeSave($insert);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['parent_id' => 'id'])->where("parent_type = 'post'");
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getCcount() {
            $command = static::getDb()->createCommand("select count(*) as kilk from comment where parent_id = {$this->id}")->queryAll();
            return $command[0]['kilk'];
    }
    
    public function rules()
    {
        return [
            [['title', 'content', 'post_type_id'], 'required'],
        ];
    }

}
