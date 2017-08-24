<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_delivery_service".
 *
 * @property integer $id
 * @property string $order_delivery_code
 * @property string $sp_delivery_service
 */
class MappingDeliveryServiceDvad extends \yii\db\ActiveRecord
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
        return 'mapping_delivery_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_delivery_code', 'sp_delivery_service'], 'string', 'max' => 45],
            [['status_active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_delivery_code' => 'Код доставки',
            'sp_delivery_service' => 'Сервисы доставки',
            'status_active' => 'Статус'
        ];
    }
}
