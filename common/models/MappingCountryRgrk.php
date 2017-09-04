<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_country".
 *
 * @property integer $id
 * @property string $sp_country
 * @property string $sp_so_country
 * @property string $sp_delivery_service
 * @property string $currency_id
 */
class MappingCountryRgrk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_country';
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
            [['sp_country', 'sp_so_country', 'sp_delivery_service', 'currency_id'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sp_country' => 'Sp Country',
            'sp_so_country' => 'Sp So Country',
            'sp_delivery_service' => 'Sp Delivery Service',
            'currency_id' => 'Currency ID',
            'status_active' => 'Статус'
        ];
    }
}
