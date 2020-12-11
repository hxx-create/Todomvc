<?php

namespace app\models;

use yii\mongodb\ActiveRecord;

class Todo extends ActiveRecord
{
    public static function collectionName()
    {
        return 'todo';
    }

    public function attributes()
    {
        return ['_id', 'content','status','userid'];
    }

}