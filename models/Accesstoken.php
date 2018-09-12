<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_accesstoken".
 *
 * @property integer $TokenID
 * @property integer $agency_id
 * @property string $RequestToken
 * @property string $AccessToken
 * @property string $access_date 
 * @property integer $TokenUsed
 */
class Accesstoken extends \yii\db\ActiveRecord
{
    public $RSTLName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_accesstoken';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agency_id', 'TokenUsed'], 'integer'],
            [['access_date'], 'safe'],
            [['RequestToken', 'AccessToken'], 'string', 'max' => 100],
            [['agency_id'], 'unique'],
            [['agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agency::className(), 'targetAttribute' => ['agency_id' => 'agency_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TokenID' => 'Token ID',
            'agency_id' => 'Agency',
            'RSTLName'=>'RSTL',
            'RequestToken' => 'Request Token',
            'AccessToken' => 'Access Token',
            'TokenUsed' => 'Token Used'
        ];
    }
    public function beforeSave($insert) {
        if($this->isNewRecord){//Add Request on New Record only
            $this->RequestToken= sha1(date('Y-m-d H:m:s'.$this->agency_id));
        }
        $this->AccessToken= sha1(date('Y-m-d H:m:s'.$this->agency->region_id));
        return parent::beforeSave($insert);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasOne(Agency::className(), ['agency_id' => 'agency_id']);
    }
}
