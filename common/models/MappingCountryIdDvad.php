<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "mapping_country_id".
 *
 * @property integer $id
 * @property string $order_delivery_address_countryIso
 * @property string $sp_so_country
 */
class MappingCountryIdDvad extends ActiveRecord
{

    public static function getDb()
    {
        return \Yii::$app->userDb;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapping_country_id';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_delivery_address_countryIso', 'sp_so_country'], 'string', 'max' => 45],
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
            'order_delivery_address_countryIso' => 'Символьный код',
            'sp_so_country' => 'Страна',
            'status_active' => 'Статус'
        ];
    }


}
