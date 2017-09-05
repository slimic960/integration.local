<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer_product_id".
 *
 * @property integer $id
 * @property string $sp_offer
 * @property string $site
 * @property string $product_name
 * @property integer $status_active
 */
class MappingOfferProductId2K extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_offer_product_id';
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
            [['status_active'], 'integer'],
            [['sp_offer', 'site'], 'string', 'max' => 45],
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
            'site' => 'Site',
            'product_name' => 'Product Name',
            'status_active' => 'Статус',
        ];
    }
}
