<?php

namespace app\models\lab;

use Yii;

/**
 * This is the model class for table "tbl_analysis".
 *
 * @property integer $analysis_id
 * @property string $date_analysis
 * @property integer $rstl_id
 * @property integer $pstcanalysis_id
 * @property integer $request_id
 * @property integer $sample_id
 * @property string $sample_code
 * @property string $testname
 * @property string $method
 * @property string $references
 * @property integer $quantity
 * @property string $fee
 * @property integer $test_id
 * @property integer $testcategory_id
 * @property integer $sample_type_id
 * @property integer $cancelled
 * @property integer $user_id
 * @property integer $is_package
 * @property integer $type_fee_id
 * @property integer $old_sample_id
 * @property integer $analysis_old_id
 * @property integer $oldColumn_taggingId
 * @property string $oldColumn_result
 * @property integer $oldColumn_package_count
 * @property string $oldColumn_requestId
 * @property integer $oldColumn_deleted
 * @property integer $methodreference_id
 * @property integer $testname_id
 *
 * @property Sample $sample
 * @property Request $request
 */
class Analysis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_analysis';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('eulims_labdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_analysis', 'rstl_id', 'pstcanalysis_id', 'request_id', 'sample_id', 'sample_code', 'testname', 'method', 'references', 'quantity', 'test_id', 'testcategory_id', 'sample_type_id'], 'required'],
            [['date_analysis'], 'safe'],
            [['rstl_id', 'pstcanalysis_id', 'request_id', 'sample_id', 'quantity', 'test_id', 'testcategory_id', 'sample_type_id', 'cancelled', 'user_id', 'is_package', 'type_fee_id', 'old_sample_id', 'analysis_old_id', 'oldColumn_taggingId', 'oldColumn_package_count', 'oldColumn_deleted', 'methodreference_id', 'testname_id'], 'integer'],
            [['fee'], 'number'],
            [['sample_code'], 'string', 'max' => 20],
            [['testname', 'oldColumn_result'], 'string', 'max' => 200],
            [['method'], 'string', 'max' => 150],
            [['references'], 'string', 'max' => 100],
            [['oldColumn_requestId'], 'string', 'max' => 50],
            [['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sample::className(), 'targetAttribute' => ['sample_id' => 'sample_id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'request_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'analysis_id' => 'Analysis ID',
            'date_analysis' => 'Date Analysis',
            'rstl_id' => 'Rstl ID',
            'pstcanalysis_id' => 'Pstcanalysis ID',
            'request_id' => 'Request ID',
            'sample_id' => 'Sample ID',
            'sample_code' => 'Sample Code',
            'testname' => 'Testname',
            'method' => 'Method',
            'references' => 'References',
            'quantity' => 'Quantity',
            'fee' => 'Fee',
            'test_id' => 'Test ID',
            'testcategory_id' => 'Testcategory ID',
            'sample_type_id' => 'Sample Type ID',
            'cancelled' => 'Cancelled',
            'user_id' => 'User ID',
            'is_package' => 'Is Package',
            'type_fee_id' => 'Type Fee ID',
            'old_sample_id' => 'Old Sample ID',
            'analysis_old_id' => 'Analysis Old ID',
            'oldColumn_taggingId' => 'Old Column Tagging ID',
            'oldColumn_result' => 'Old Column Result',
            'oldColumn_package_count' => 'Old Column Package Count',
            'oldColumn_requestId' => 'Old Column Request ID',
            'oldColumn_deleted' => 'Old Column Deleted',
            'methodreference_id' => 'Methodreference ID',
            'testname_id' => 'Testname ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSample()
    {
        return $this->hasOne(Sample::className(), ['sample_id' => 'sample_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['request_id' => 'request_id']);
    }
}
