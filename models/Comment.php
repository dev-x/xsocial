<?php

namespace app\models;

class Comment extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'comment';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }
        public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent_id',
            'parent_type' => 'Parent_type',
            'user_id' => 'user_id',
            'content' => 'Content',
            );
    }
    
    function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
        

    public function rules()
    {
        return [
            ['content', 'required'],
            ['parent_id', 'required']
        ];
    }

}
