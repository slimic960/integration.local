<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_offer".
 *
 * @property integer $id
 * @property string $sp_offer
 * @property string $kazeco_offer
 * @property integer $active
 */
class MappingOfferKazeco extends \yii\db\ActiveRecord
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
        return Yii::$app->get('dbKazeco');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['sp_offer'], 'string', 'max' => 45],
            [['kazeco_offer'], 'string', 'max' => 255],
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
            'kazeco_offer' => 'Kazeco Offer',
            'active' => 'Active',
        ];
    }
}
