<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_statuses".
 *
 * @property integer $id
 * @property string $sostatus
 * @property string $status
 * @property string $status_name
 * @property integer $status_terminal
 */
class MappingStatusesBY extends \yii\db\ActiveRecord
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
        return Yii::$app->get('dbBY');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_terminal'], 'integer'],
            [['sostatus', 'status', 'status_name'], 'string', 'max' => 45],
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
            'status' => 'Status',
            'status_name' => 'Status Name',
            'status_terminal' => 'Status Terminal',
        ];
    }
}
