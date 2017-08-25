<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_delivery_service".
 *
 * @property integer $id
 * @property string $sp_delivery_service
 * @property string $kz_delivery
 * @property string $kz_delivery_name
 */
class MappingDeliveryServiceKazeco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_delivery_service';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbKazeco');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sp_delivery_service', 'kz_delivery', 'kz_delivery_name'], 'string', 'max' => 45],
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
            'sp_delivery_service' => 'Sp Delivery Service',
            'kz_delivery' => 'Kz Delivery',
            'kz_delivery_name' => 'Kz Delivery Name',
        ];
    }
}
