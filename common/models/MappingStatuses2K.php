<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_statuses".
 *
 * @property integer $id
 * @property string $sostatus
 * @property string $main_status
 * @property integer $status_terminal
 */
class MappingStatuses2K extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_statuses';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2K');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_terminal'], 'integer'],
            [['sostatus', 'main_status'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sostatus' => 'Sostatus',
            'main_status' => 'Main Status',
            'status_terminal' => 'Статус',
        ];
    }
}
