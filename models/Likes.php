<?php
namespace app\models;

class Likes extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'likes';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }
    
    public function attributeLabels()
    {
        return array(
            'id' => 'id',
            'user_id' => 'user id',
            'parent_id' => 'parent id',
            'parent_type' => 'parent_type',
        );
    }
    
     public function rules()
    {
        return [
            [['user_id', 'parent_id', 'parent_type'], 'required'],
        ];
    }
    
}