<?php
/**
 * Created by PhpStorm.
 * User: Admin1
 * Date: 16.08.2017
 * Time: 12:54
 */

namespace frontend\models;

use yii\db\ActiveRecord;

class CallEditForm extends ActiveRecord
{
    public $fieldedit;
    public $callcenter;
    public static $_tableName;

    public static function tableName()
    {
        return self::$_tableName;
    }

    public function rules()
    {
        return [
            [['fieldedit'], 'required', 'message' => 'Заполните поле'],
            [['callcenter'], 'required', 'message' => 'Заполните поле'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fieldedit' => 'Добавить',
            'callcenter' => 'Добавить'
        ];
    }

}