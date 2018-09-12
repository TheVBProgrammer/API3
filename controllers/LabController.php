<?php

namespace app\controllers;
use app\components\Functions;
use app\models\Accesstoken;
use yii\web\UnauthorizedHttpException;

class LabController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionGetLab(){
        $get= \Yii::$app->request->get();
        $id=$get['id'];
        $rstl_id=$get['rid'];
        $tk=$get['tk'];
        $Func=new Functions();
        $ret=$Func->CheckToken($rstl_id, $tk);
        if($ret['Success']){
            $Proc="spGetRSTLLaboratory(:mRSTL_ID)";
            $Params=[
                ':mRSTL_ID'=>$rstl_id
            ];
            $Connection= \Yii::$app->db;
            $Rows=$Func->ExecuteStoredProcedureRows($Proc, $Params, $Connection);
        }else{
            throw new UnauthorizedHttpException($ret['Description']);
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGettestname(){
        $get= \Yii::$app->request->get();
        $rstl_id=$get['rid'];
        $tk=$get['tk'];
        $Func=new Functions();
        $ret=$Func->CheckToken($rstl_id, $tk);
        if($ret['Success']){
            $Proc="spGetTestName()";
            $Connection= \Yii::$app->db;
            $Rows=$Func->ExecuteStoredProcedureRows($Proc, [], $Connection);
        }else{
            throw new UnauthorizedHttpException($ret['Description']);
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGettestnameMethod(){
        $get= \Yii::$app->request->get();
        $id=$get['id'];
        $rstl_id=$get['rid'];
        $tk=$get['tk'];
        $Func=new Functions();
        $ret=$Func->CheckToken($rstl_id, $tk);
        if($ret['Success']){
            $Proc="spGetTestNameMethod(:mTestNameID)";
            $Connection= \Yii::$app->db;
            $Rows=$Func->ExecuteStoredProcedureRows($Proc, [':mTestNameID'=>$id], $Connection);
        }else{
            throw new UnauthorizedHttpException($ret['Description']); 
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGetsampletypeTestname(){
        $get= \Yii::$app->request->get();
        $id=$get['id'];
        $rstl_id=$get['rid'];
        $tk=$get['tk'];
        $Func=new Functions();
        $ret=$Func->CheckToken($rstl_id, $tk);
        if($ret['Success']){
            $Proc="spGetSampleTypeTestName(:mSampleTypeID)";
            $Connection= \Yii::$app->db;
            $Rows=$Func->ExecuteStoredProcedureRows($Proc, [':mSampleTypeID'=>$id], $Connection);
        }else{
           throw new UnauthorizedHttpException($ret['Description']);  
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGetlabsampletype(){
        $get= \Yii::$app->request->get();
        $id=$get['id'];
        $rstl_id=$get['rid'];
        $tk=$get['tk'];
        $Func=new Functions();
        $ret=$Func->CheckToken($rstl_id, $tk);
        if($ret['Success']){
            $Proc="spGetLabSampleType(:mSampleTypeID)";
            $Params=[
                ':mSampleTypeID'=>$id
            ];
            $Connection= \Yii::$app->db;
            $Rows=$Func->ExecuteStoredProcedureRows($Proc, $Params, $Connection);
        }else{
            throw new UnauthorizedHttpException($ret['Description']);  
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $Rows;
    }
    public function actionGetsampletype(){
        $get= \Yii::$app->request->get();
        $rstl_id=$get['rid'];
        $tk=$get['tk'];
        $Func=new Functions();
        $ret=$Func->CheckToken($rstl_id, $tk);
        if($ret['Success']){
            $Proc="spGetSampleTypes()";
            $Connection= \Yii::$app->db;
            $Rows=$Func->ExecuteStoredProcedureRows($Proc, [], $Connection);
        }else{
            throw new UnauthorizedHttpException($ret['Description']);  
        }
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
