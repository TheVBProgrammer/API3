<?php

namespace app\controllers;
use app\components\Functions;
use app\models\Accesstoken;


class LabController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    private function CheckToken($id,$tk){
        $Accesstoken= Accesstoken::find()->where(['agency_id'=>$id,'Request_Token'=>$tk])->one();
        if(!$Accesstoken){//Unauthorized
            $ret=[
              'Success'=>false,
              'Description'=>'Unauthorized Access'
            ];
        }else{
            if($Accesstoken){
                
            }
        }
    }
    public function actionGetLab(){
        $get= \Yii::$app->request->get();
        $rstl_id=$get['id'];
        $tk=$get['tk'];
        $Func=new Functions();
        $Proc="spGetRSTLLaboratory(:mRSTL_ID)";
        $Params=[
            ':mRSTL_ID'=>$rstl_id
        ];
        $Connection= \Yii::$app->db;
        $Rows=$Func->ExecuteStoredProcedureRows($Proc, $Params, $Connection);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGettestname(){
        $Func=new Functions();
        $Proc="spGetTestName()";
        $Connection= \Yii::$app->db;
        $Rows=$Func->ExecuteStoredProcedureRows($Proc, [], $Connection);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGettestnameMethod($id){
        $Func=new Functions();
        $Proc="spGetTestNameMethod(:mTestNameID)";
        $Connection= \Yii::$app->db;
        $Rows=$Func->ExecuteStoredProcedureRows($Proc, [':mTestNameID'=>$id], $Connection);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGetsampletypeTestname($id){
        $Func=new Functions();
        $Proc="spGetSampleTypeTestName(:mSampleTypeID)";
        $Connection= \Yii::$app->db;
        $Rows=$Func->ExecuteStoredProcedureRows($Proc, [':mSampleTypeID'=>$id], $Connection);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGetlabsampletype($id){
        $Func=new Functions();
        $Proc="spGetLabSampleType(:mSampleTypeID)";
        $Params=[
            ':mSampleTypeID'=>$id
        ];
        $Connection= \Yii::$app->db;
        $Rows=$Func->ExecuteStoredProcedureRows($Proc, $Params, $Connection);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGetsampletype(){
        $Func=new Functions();
        $Proc="spGetSampleTypes()";
        $Connection= \Yii::$app->db;
        $Rows=$Func->ExecuteStoredProcedureRows($Proc, [], $Connection);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionPostLab(){
        $post= \Yii::$app->request->post();
        if($post){
            $Token=$post['tk'];
            $rstl_id=$post['id'];
            
            $Accesstoken= Accesstoken::find()->where(['agency_id'=>$rstl_id,'Request_Token'=>$Token])->one();
            if(!$Accesstoken){//Invalid Token, unAuthorized
                $response=[
                   'status'=>'1100',
                   'message'=>'Unathorized Access'
                ];
            }else{//Successful
                
            }
        }
    }
}
