<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rstl".
 *
 * @property integer $agency_id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 *
 * @property Accesstoken[] $Accesstokens
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'code'], 'required'],
            [['region_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agency_id' => 'Agency ID',
            'region_id' => 'Region ID',
            'name' => 'RSTL',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesstokens()
    {
        return $this->hasMany(Accesstoken::className(), ['agency_id' => 'agency_id']);
    }
}
