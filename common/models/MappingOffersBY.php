<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offers".
 *
 * @property integer $id
 * @property string $sp_offer
 * @property string $by_offer
 * @property integer $productid
 * @property integer $active
 */
class MappingOffersBY extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_offers';
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
            [['productid', 'active'], 'integer'],
            [['sp_offer', 'by_offer'], 'string', 'max' => 255],
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
            'by_offer' => 'By Offer',
            'productid' => 'Productid',
            'active' => 'Статус',
        ];
    }
}
