<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mapping_country".
 *
 * @property integer $id
 * @property string $sp_country
 * @property string $country_kazeco
 * @property string $sp_so_country
 * @property string $currency_id
 */
class MappingCountryKazeco extends \yii\db\ActiveRecord
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
        return Yii::$app->get('dbKazeco');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sp_country', 'country_kazeco', 'sp_so_country', 'currency_id'], 'string', 'max' => 45],
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
            'sp_country' => 'Sp Country',
            'country_kazeco' => 'Country Kazeco',
            'sp_so_country' => 'Sp So Country',
            'currency_id' => 'Currency ID',
        ];
    }
}
