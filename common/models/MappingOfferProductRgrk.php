<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer_product".
 *
 * @property integer $id
 * @property string $sp_offer
 * @property string $good_id
 * @property string $productid
 * @property string $gift
 * @property string $product_name
 */
class MappingOfferProductRgrk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_offer_product';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbRgrk');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_active'], 'integer'],
            [['gift',], 'boolean'],
            [['sp_offer', 'good_id', 'productid'], 'string', 'max' => 45],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sp_offer' => 'Sp Offer',
            'good_id' => 'Good ID',
            'productid' => 'Productid',
            'gift' => 'Подарок',
            'product_name' => 'Product Name',
            'status_active' => 'Status',
        ];
    }
}
