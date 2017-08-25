<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer".
 *
 * @property integer $id
 * @property string $sp_offer
 * @property string $navigant_offer
 * @property integer $active
 */
class MappingOfferNavigant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_offer';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbNavigant');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['sp_offer'], 'string', 'max' => 45],
            [['navigant_offer'], 'string', 'max' => 255],
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
            'navigant_offer' => 'Navigant Offer',
            'active' => 'Active',
        ];
    }
}
