<?php

namespace app\models\lab;

use Yii;

/**
 * This is the model class for table "tbl_request".
 *
 * @property integer $request_id
 * @property string $request_ref_num
 * @property string $request_datetime
 * @property integer $rstl_id
 * @property integer $lab_id
 * @property integer $customer_id
 * @property integer $payment_type_id
 * @property string $modeofrelease_ids
 * @property string $discount
 * @property integer $discount_id
 * @property integer $purpose_id
 * @property string $total
 * @property string $report_due
 * @property string $conforme
 * @property string $receivedBy
 * @property integer $created_at
 * @property integer $posted
 * @property integer $status_id
 * @property integer $selected
 * @property integer $other_fees_id
 * @property integer $request_type_id
 * @property string $position
 * @property string $recommended_due_date
 * @property string $est_date_completion
 * @property string $items_receive_by
 * @property string $equipment_release_date
 * @property string $certificate_release_date
 * @property string $released_by
 * @property string $received_by
 * @property integer $payment_status_id
 * @property integer $completed
 * @property integer $request_old_id
 * @property string $oldColumn_requestId
 * @property integer $oldColumn_sublabId
 * @property integer $oldColumn_orId
 * @property double $oldColumn_completed
 * @property integer $oldColumn_cancelled
 * @property string $oldColumn_create_time
 * @property integer $customer_old_id
 * @property integer $tmpCustomerID
 *
 * @property Analysis[] $analyses
 * @property Lab $lab
 * @property Customer $customer
 * @property Discount $discount0
 * @property Purpose $purpose
 * @property Status $status
 * @property Customer $customer0
 * @property Paymenttype $paymentType
 * @property Sample[] $samples
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request';
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
            [['request_datetime', 'rstl_id', 'lab_id', 'customer_id', 'payment_type_id', 'modeofrelease_ids', 'discount_id', 'purpose_id', 'report_due', 'conforme', 'receivedBy', 'created_at'], 'required'],
            [['request_datetime', 'report_due', 'recommended_due_date', 'est_date_completion', 'equipment_release_date', 'certificate_release_date', 'oldColumn_create_time'], 'safe'],
            [['rstl_id', 'lab_id', 'customer_id', 'payment_type_id', 'discount_id', 'purpose_id', 'created_at', 'posted', 'status_id', 'selected', 'other_fees_id', 'request_type_id', 'payment_status_id', 'completed', 'request_old_id', 'oldColumn_sublabId', 'oldColumn_orId', 'oldColumn_cancelled', 'customer_old_id', 'tmpCustomerID'], 'integer'],
            [['discount', 'total', 'oldColumn_completed'], 'number'],
            [['request_ref_num', 'modeofrelease_ids', 'conforme', 'receivedBy', 'oldColumn_requestId'], 'string', 'max' => 50],
            [['position', 'items_receive_by', 'released_by', 'received_by'], 'string', 'max' => 100],
            [['request_ref_num'], 'unique'],
            [['lab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['lab_id' => 'lab_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['discount_id' => 'discount_id']],
            [['purpose_id'], 'exist', 'skipOnError' => true, 'targetClass' => Purpose::className(), 'targetAttribute' => ['purpose_id' => 'purpose_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'status_id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['payment_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttype::className(), 'targetAttribute' => ['payment_type_id' => 'payment_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_id' => 'Request ID',
            'request_ref_num' => 'Request Ref Num',
            'request_datetime' => 'Request Datetime',
            'rstl_id' => 'Rstl ID',
            'lab_id' => 'Lab ID',
            'customer_id' => 'Customer ID',
            'payment_type_id' => 'Payment Type ID',
            'modeofrelease_ids' => 'Modeofrelease Ids',
            'discount' => 'Discount',
            'discount_id' => 'Discount ID',
            'purpose_id' => 'Purpose ID',
            'total' => 'Total',
            'report_due' => 'Report Due',
            'conforme' => 'Conforme',
            'receivedBy' => 'Received By',
            'created_at' => 'Created At',
            'posted' => 'Posted',
            'status_id' => 'Status ID',
            'selected' => 'Selected',
            'other_fees_id' => 'Other Fees ID',
            'request_type_id' => 'Request Type ID',
            'position' => 'Position',
            'recommended_due_date' => 'Recommended Due Date',
            'est_date_completion' => 'Est Date Completion',
            'items_receive_by' => 'Items Receive By',
            'equipment_release_date' => 'Equipment Release Date',
            'certificate_release_date' => 'Certificate Release Date',
            'released_by' => 'Released By',
            'received_by' => 'Received By',
            'payment_status_id' => 'Payment Status ID',
            'completed' => 'Completed',
            'request_old_id' => 'Request Old ID',
            'oldColumn_requestId' => 'Old Column Request ID',
            'oldColumn_sublabId' => 'Old Column Sublab ID',
            'oldColumn_orId' => 'Old Column Or ID',
            'oldColumn_completed' => 'Old Column Completed',
            'oldColumn_cancelled' => 'Old Column Cancelled',
            'oldColumn_create_time' => 'Old Column Create Time',
            'customer_old_id' => 'Customer Old ID',
            'tmpCustomerID' => 'Tmp Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalyses()
    {
        return $this->hasMany(Analysis::className(), ['request_id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['lab_id' => 'lab_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount0()
    {
        return $this->hasOne(Discount::className(), ['discount_id' => 'discount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurpose()
    {
        return $this->hasOne(Purpose::className(), ['purpose_id' => 'purpose_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer0()
    {
        return $this->hasOne(Customer::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentType()
    {
        return $this->hasOne(Paymenttype::className(), ['payment_type_id' => 'payment_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Sample::className(), ['request_id' => 'request_id']);
    }
}
