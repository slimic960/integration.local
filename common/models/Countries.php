<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $code
 * @property string $name
 * @property string $fullname
 * @property string $alpha2
 * @property string $alpha3
 * @property string $location
 * @property integer $active
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'fullname', 'alpha2', 'alpha3', 'location', 'active'], 'required'],
            [['code', 'active'], 'integer'],
            [['name', 'fullname'], 'string', 'max' => 250],
            [['alpha2', 'alpha3'], 'string', 'max' => 5],
            [['location'], 'string', 'max' => 45],
            [['alpha2'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'fullname' => 'Fullname',
            'alpha2' => 'Alpha2',
            'alpha3' => 'Alpha3',
            'location' => 'Location',
            'active' => 'Active',
        ];
    }
}
