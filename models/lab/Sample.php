<?php

namespace app\models\lab;

use Yii;

/**
 * This is the model class for table "tbl_sample".
 *
 * @property integer $sample_id
 * @property integer $rstl_id
 * @property integer $pstcsample_id
 * @property integer $package_id
 * @property string $package_rate
 * @property integer $testcategory_id
 * @property integer $sampletype_id
 * @property string $sample_code
 * @property string $samplename
 * @property string $description
 * @property string $sampling_date
 * @property string $remarks
 * @property integer $request_id
 * @property integer $sample_month
 * @property integer $sample_year
 * @property integer $active
 * @property integer $completed
 * @property integer $sample_old_id
 * @property string $oldColumn_requestId
 * @property double $oldColumn_completed
 * @property string $oldColumn_datedisposal
 * @property string $oldColumn_mannerofdisposal
 * @property integer $oldColumn_batch_num
 * @property integer $oldColumn_package_count
 *
 * @property Analysis[] $analyses
 * @property Sampletype $sampletype
 * @property Request $request
 * @property Packagelist $package
 * @property Testcategory $testcategory
 */
class Sample extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sample';
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
            [['rstl_id', 'sampletype_id', 'samplename', 'description', 'sampling_date', 'request_id', 'sample_month', 'sample_year'], 'required'],
            [['rstl_id', 'pstcsample_id', 'package_id', 'testcategory_id', 'sampletype_id', 'request_id', 'sample_month', 'sample_year', 'active', 'completed', 'sample_old_id', 'oldColumn_batch_num', 'oldColumn_package_count'], 'integer'],
            [['package_rate', 'oldColumn_completed'], 'number'],
            [['description'], 'string'],
            [['sampling_date', 'oldColumn_datedisposal'], 'safe'],
            [['sample_code'], 'string', 'max' => 20],
            [['samplename', 'oldColumn_requestId'], 'string', 'max' => 50],
            [['remarks'], 'string', 'max' => 150],
            [['oldColumn_mannerofdisposal'], 'string', 'max' => 200],
            [['sampletype_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sampletype::className(), 'targetAttribute' => ['sampletype_id' => 'sampletype_id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'request_id']],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Packagelist::className(), 'targetAttribute' => ['package_id' => 'package_id']],
            [['testcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Testcategory::className(), 'targetAttribute' => ['testcategory_id' => 'testcategory_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sample_id' => 'Sample ID',
            'rstl_id' => 'Rstl ID',
            'pstcsample_id' => 'Pstcsample ID',
            'package_id' => 'Package ID',
            'package_rate' => 'Package Rate',
            'testcategory_id' => 'Testcategory ID',
            'sampletype_id' => 'Sampletype ID',
            'sample_code' => 'Sample Code',
            'samplename' => 'Samplename',
            'description' => 'Description',
            'sampling_date' => 'Sampling Date',
            'remarks' => 'Remarks',
            'request_id' => 'Request ID',
            'sample_month' => 'Sample Month',
            'sample_year' => 'Sample Year',
            'active' => 'Active',
            'completed' => 'Completed',
            'sample_old_id' => 'Sample Old ID',
            'oldColumn_requestId' => 'Old Column Request ID',
            'oldColumn_completed' => 'Old Column Completed',
            'oldColumn_datedisposal' => 'Old Column Datedisposal',
            'oldColumn_mannerofdisposal' => 'Old Column Mannerofdisposal',
            'oldColumn_batch_num' => 'Old Column Batch Num',
            'oldColumn_package_count' => 'Old Column Package Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalyses()
    {
        return $this->hasMany(Analysis::className(), ['sample_id' => 'sample_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSampletype()
    {
        return $this->hasOne(Sampletype::className(), ['sampletype_id' => 'sampletype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['request_id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Packagelist::className(), ['package_id' => 'package_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestcategory()
    {
        return $this->hasOne(Testcategory::className(), ['testcategory_id' => 'testcategory_id']);
    }
}
