<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer_product_id".
 *
 * @property integer $id
 * @property string $offer
 * @property string $order_items_productId
 * @property integer $active
 */
class MappingOfferProductIdDvad extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->dbDvad;
    }
    /**
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_offer_product_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['offer', 'order_items_productId'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offer' => 'Оффер',
            'order_items_productId' => 'Order Items Product ID',
            'active' => 'Статус',
        ];
    }
}
