<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer_product".
 *
 * @property integer $id
 * @property integer $productid
 * @property string $product_name
 * @property string $product_kazeco
 * @property string $sp_offer
 * @property integer $gift
 * @property integer $active
 */
class MappingOfferProductKazeco extends \yii\db\ActiveRecord
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
        return Yii::$app->get('dbKazeco');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productid', 'active'], 'integer'],
            [['gift',], 'boolean'],
            [['product_name', 'product_kazeco'], 'string', 'max' => 255],
            [['sp_offer'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productid' => 'Productid',
            'product_name' => 'Product Name',
            'product_kazeco' => 'Product Kazeco',
            'sp_offer' => 'Sp Offer',
            'gift' => 'Подарок',
            'active' => 'Active',
        ];
    }
}
