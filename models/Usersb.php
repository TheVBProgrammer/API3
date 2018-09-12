<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $auth_key
 * @property string $created_at
 * @property string $updated_at
 * @property string $lastvisit_at
 * @property integer $superuser
 * @property integer $status
 * @property string $password write-only password
 *
 * @property Profiles $profiles
 */
class Usersb extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_users';
    }
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['created_at','updated_at', 'lastvisit_at'], 'safe'],
            [['superuser', 'status'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['password_hash', 'email', 'auth_key'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at'=>'Updated At',
            'lastvisit_at' => 'LastVisit At',
            'superuser' => 'SuperUser',
            'status' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'id']);
    }
    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    public static function findIdentity($id) {
        return static::findOne($id);
    }
    public function getId() {
        return $this->id;
    }
    public function getAuthKey() {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey) {
        return $this->auth_key===$authKey;
    }
    public function beforeSave($insert) {
        $this->auth_key= \Yii::$app->security->generateRandomString();
        if($this->isAttributeChanged("password_hash")){
            $this->setPassword($this->password_hash);
        }
        return parent::beforeSave($insert);
    }
    public function validatePassword($password){
        //$mPassword=Yii::$app->security->generatePasswordHash($password);
        //echo $mPassword;
       // exit;
       // return $this->password_hash==md5($password);
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        //$this->password_hash = Yii::$app->security->generatePasswordHash($password);
        $this->password_hash = md5($password);
    }
    public static function findByUsername($username)
    {
        $users = Users::findAll(['status'=>1]);
        foreach ($users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
}
