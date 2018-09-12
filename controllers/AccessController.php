<?php

namespace app\controllers;

use Yii;
use app\models\Accesstoken;
use app\models\AccesstokenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;
use Spatie\ArrayToXml\ArrayToXml;
/**
 * AccessController implements the CRUD actions for Accesstoken model.
 */
class AccessController extends Controller
{
    //To Disable Cross-site request Forgery (CSRF) Validation
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'getaccesstoken'=>['GET'],
                    'synchronize'=>['POST','GET'],
                    'synch'=>['GET']
                ],
            ],
        ];
    }

    /**
     * This Action request for access token prior to synchronization
     */
    public function actionGetAccessToken(){
        $RTOken="";
        $AgencyID=0;
        $AccToken="";
        $ErrorCode=0;
        //header('Access-Control-Allow-Origin: *');  
        \Yii::$app->response->format= Response::FORMAT_JSON;
        if(isset($_GET['tk'])){
            //Validate Request Token
            $RTOken=$_GET['tk'];
            $AgencyID=$_GET['id'];
            //$AccessToken= Accesstoken::model()->findByAttributes(array('rstl_id'=>$AgencyID,'RequestToken'=>$RTOken));
            $AccessToken= Accesstoken::findOne(['agency_id'=>$AgencyID,'RequestToken'=>$RTOken]);
            
            if($AccessToken){
                //Agency Region
                $ErrorCode=200;
                $AccessToken->AccessToken=sha1(date('Ymdhis'));
                $AccessToken->TokenUsed=0;
                $AccessToken->save();
                $AccToken=$AccessToken->AccessToken;
                $ResponseArr=array(
                    'ErrorCode'=>0,
                    'Token'=>$AccToken,
                    'Status'=>200
                );
                
            }else{
                $AccToken="Unathorized Access";
                $ErrorCode=401;
                $ResponseArr=array(
                    'ErrorCode'=>$ErrorCode,
                    'Token'=>$AccToken,
                    'Status'=>401
                );
            }
        }else{
            $AccToken="Unathorized Access";
            $ErrorCode=401;
            $ResponseArr=array(
               'ErrorCode'=>100,
               'Token'=>$AccToken,
               'Status'=>401
            );
        }
        return $ResponseArr;
    }
    public function actionShowcustomer(){
        $ErrorCode=0;
        $id=$_GET['id'];
        $tk=$_GET['tk'];
        $CustomerCode=$_GET['cc'];
        \Yii::$app->response->format= Response::FORMAT_JSON;
        $AccessToken= Accesstoken::findOne(['rstl_id'=>$id,'AccessToken'=>$tk]);
        if($AccessToken){
            if($AccessToken->TokenUsed==0 && $AccessToken->AccessToken==$tk){
                $Proc = "CALL spShowCustomer(:CustomerCode)";
                $connection = \Yii::$app->db;
                $command = $connection->createCommand($Proc);
                $command->bindParam(":CustomerCode", $CustomerCode, \PDO::PARAM_STR);
                $Customers = $command->queryAll();
                $ErrorCode=200;//ok
                $des=[
                    'ErrorCode'=>$ErrorCode,
                    'Description'=>'Success'
                ];
                $Result=array_merge($des,$Customers);
            }else if($AccessToken->TokenUsed==1 && $AccessToken->AccessToken==$tk){
                $ErrorCode=301;
                $des=[
                    'ErrorCode'=>$ErrorCode,
                    'Description'=>'Token Expired'
                ];
                $Customers=array();
                $Result=array_merge($des,$Customers);
                //$Result=$Customers;
                $ErrorCode=403;//forbidden
            }else{
                $ErrorCode=300;
                $des=[
                    'ErrorCode'=>$ErrorCode,
                    'Description'=>'Invalid Access Token'
                ];
                $Customers=array();
                $Result=array_merge($des,$Customers);
                //$Result=$Customers;
            }
        }else{
            $ErrorCode=300;
            $Customers=array();
            $des=[
                'ErrorCode'=>$ErrorCode,
                'Description'=>'Invalid Access Token'
            ];
            $Result=array_merge($des,$Customers);
            //$Result=$Customers;
        }
        return $Result;
    }
    public function actionGetapikey($id){
        $AccessToken=Accesstoken::findOne(['rstl_id'=>$id]);
        return $AccessToken->RequestToken;
    }
    public function actionGetcustomers(){
        $ErrorCode=0;
        $id=$_GET['id'];
        $tk=$_GET['tk'];
        $rstlID=$_GET['rid'];
        \Yii::$app->response->format= Response::FORMAT_JSON;
        $AccessToken= Accesstoken::findOne(['rstl_id'=>$id,'AccessToken'=>$tk]);
        if($AccessToken){
            if($AccessToken->TokenUsed==0 && $AccessToken->AccessToken==$tk){
                $Proc = "CALL spGetCustomers(:rstlID)";
                $connection = \Yii::$app->db;
                $command = $connection->createCommand($Proc);
                $command->bindParam(":rstlID", $rstlID, \PDO::PARAM_INT);
                $Customers = $command->queryAll();
                $ErrorCode=200;//ok
                $des=[
                    'ErrorCode'=>$ErrorCode,
                    'Description'=>'Success'
                ];
                $Result=array_merge($des,$Customers);
                //$Result=$Customers;
            }else if($AccessToken->TokenUsed==1 && $AccessToken->AccessToken==$tk){
                $ErrorCode=301;
                $des=[
                    'ErrorCode'=>$ErrorCode,
                    'Description'=>'Token Expired'
                ];
                $Customers=array();
                $Result=array_merge($des,$Customers);
                //$Result=$Customers;
                $ErrorCode=403;//forbidden
            }else{
                $ErrorCode=300;
                $des=[
                    'ErrorCode'=>$ErrorCode,
                    'Description'=>'Invalid Access Token'
                ];
                $Customers=array();
                $Result=array_merge($des,$Customers);
                //$Result=$Customers;
            }
        }else{
            $ErrorCode=300;
            $Customers=array();
            $des=[
                'ErrorCode'=>$ErrorCode,
                'Description'=>'Invalid Access Token'
            ];
            $Result=array_merge($des,$Customers);
            //$Result=$Customers;
        }
        return $Result;
        //echo "<pre>".PHP_EOL;
        //var_dump($Result);
        //echo "</pre>".PHP_EOL;
    }
    public function actionSynch(){
        \Yii::$app->response->format= Response::FORMAT_XML;
        //$id=$_POST['id'];
        /*$ResponseArr=[
               'ErrorCode'=>200,
               'CustomerCode'=>1,
               'Status'=>'OK'
        ];
        */
        $regions= \app\models\Region::find()->all();
        //$result = ArrayToXml::convert($array);
        return $regions;
    }
    /**
     * This Action will post Customer Data from Local ULIMS
     */
    public function actionSynchronize(){
        $Authorized=false;
        $Proceed=false;
        $ErrorCode=401;
        $rstl_id=0;
        \Yii::$app->response->format= Response::FORMAT_XML;
        if(isset($_POST)){
            //Check for the Valid Access Token
            $AToken=$_POST['atk'];
            $rstl_id=$_POST['id'];
            //$AccessToken= Accesstoken::model()->findByAttributes(array('rstl_id'=>$rstl_id,'AccessToken'=>$AToken));
            $AccessToken= Accesstoken::findOne(['rstl_id'=>$rstl_id,'AccessToken'=>$AToken]);
            $Authorized=($AccessToken->AccessToken==$AToken);
            $Proceed=$Authorized;
        }
        
        if($Proceed){
            $ErrorCode=0;
            $CustomerXML=$_POST['xml'];
            $Proc = "CALL spSynchronizeCustomerXML(:id,:xml)";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($Proc);
            $command->bindParam(":id",$rstl_id);
            $command->bindValue(":xml",$CustomerXML);
            $CustomersReturn = $command->queryAll();
            $ResponseArr=$CustomersReturn;
        }else{
            $ResponseArr=[
               'ErrorCode'=>500,
               'CustomerCode'=>'',
               'Status'=>'Failed'
            ];
        }
        return $ResponseArr;
    }
}
