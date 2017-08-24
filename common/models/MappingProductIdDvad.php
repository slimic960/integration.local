<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_product_id".
 *
 * @property integer $id
 * @property string $order_items_productId
 * @property string $productid
 * @property string $product_name
 */
class MappingProductIdDvad extends \yii\db\ActiveRecord
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
        return 'mapping_product_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_items_productId', 'productid', 'product_name'], 'string', 'max' => 45],
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
            'order_items_productId' => 'Order Items Product ID',
            'productid' => 'Productid',
            'product_name' => 'Название продукта',
            'status_active' => 'Статус'
        ];
    }
}
