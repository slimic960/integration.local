<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer".
 *
 * @property integer $id
 * @property string $sp_offer
 * @property string $qualtouch_offer
 * @property integer $active
 */
class MappingOfferQualtouch extends \yii\db\ActiveRecord
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
        return Yii::$app->get('dbQualtouch');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['sp_offer'], 'string', 'max' => 45],
            [['qualtouch_offer'], 'string', 'max' => 255],
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
            'qualtouch_offer' => 'Qualtouch Offer',
            'active' => 'Статус',
        ];
    }
}
