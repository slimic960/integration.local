<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callcenter_mapping_id".
 *
 * @property integer $id
 * @property integer $salesorderid
 * @property string $callcenter_id
 * @property string $callcenter_code
 * @property integer $callcenter_double
 * @property string $datetime_send
 */
class CallcenterMappingId extends \yii\db\ActiveRecord
{

    public static function getDb()
    {
        return \Yii::$app->userDb;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callcenter_mapping_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salesorderid'], 'required'],
            [['salesorderid', 'callcenter_double'], 'integer'],
            [['datetime_send'], 'safe'],
            [['callcenter_id', 'callcenter_code'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salesorderid' => 'Salesorderid',
            'callcenter_id' => 'Callcenter ID',
            'callcenter_code' => 'Callcenter Code',
            'callcenter_double' => 'Callcenter Double',
            'datetime_send' => 'Datetime Send',
        ];
    }
}
