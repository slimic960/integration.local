<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Callcenter extends ActiveRecord{

    public static function tableName()
    {
        return 'merger_callcenter';
    }
}