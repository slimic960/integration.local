<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_statuses".
 *
 * @property integer $id
 * @property string $sostatus
 * @property string $dvad_status
 * @property string $dvad_status_name
 * @property integer $status_terminal
 */
class MappingStatusesDvad extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->userDb;
    }
    /**
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_terminal'], 'integer'],
            [['sostatus', 'dvad_status', 'dvad_status_name'], 'string', 'max' => 45],
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
            'dvad_status' => 'Dvad Status',
            'dvad_status_name' => 'Dvad Status Name',
            'status_terminal' => 'Status Terminal',
        ];
    }
}
