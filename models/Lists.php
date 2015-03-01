<?php

namespace app\models;

class Lists extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'lists';
    }
    
    public static function primaryKey()
    {
        return array('id');
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent_id',
            'list_type' => 'List type',
            );
    }

    public function rules()
    {
        return [
            ['', 'required'],
        ];
    }

    public static function getList($type){
        return self::find()->where(['list_type' => $type])->asArray()->all();
    }

}
