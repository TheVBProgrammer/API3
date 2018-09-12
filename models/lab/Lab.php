<?php

namespace app\models\lab;

use Yii;

/**
 * This is the model class for table "tbl_lab".
 *
 * @property integer $lab_id
 * @property string $labname
 * @property string $labcode
 * @property integer $labcount
 * @property integer $active
 *
 * @property LabSampletype $lab
 * @property LabManager[] $labManagers
 * @property RstlLab[] $rstlLabs
 * @property Testcategory[] $testcategories
 */
class Lab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_lab';
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
            [['labname', 'labcode', 'labcount', 'active'], 'required'],
            [['labcount', 'active'], 'integer'],
            [['labname'], 'string', 'max' => 50],
            [['labcode'], 'string', 'max' => 10],
            [['lab_id'], 'exist', 'skipOnError' => true, 'targetClass' => LabSampletype::className(), 'targetAttribute' => ['lab_id' => 'lab_sampletype_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_id' => 'Lab ID',
            'labname' => 'Labname',
            'labcode' => 'Labcode',
            'labcount' => 'Labcount',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(LabSampletype::className(), ['lab_sampletype_id' => 'lab_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabManagers()
    {
        return $this->hasMany(LabManager::className(), ['lab_id' => 'lab_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRstlLabs()
    {
        return $this->hasMany(RstlLab::className(), ['lab_id' => 'lab_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestcategories()
    {
        return $this->hasMany(Testcategory::className(), ['lab_id' => 'lab_id']);
    }
}
