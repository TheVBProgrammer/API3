<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\get\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
/**
 * Description of CustomerController
 *
 * @author OneLab
 */
class CustomerController extends ActiveController{
    public $modelClass="app\models\lab\Customer";
    
    /* Declare actions supported by APIs (Added in api/modules/v1/components/controller.php too) */
    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }
    /* Declare methods supported by APIs */
    protected function verbs(){
        return [
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH','POST'],
            'delete' => ['DELETE'],
            'view' => ['GET'],
            'index'=>['GET'],
        ];
    }
    public function actionTotalPage(){
        $get= Yii::$app->request->get();
        $id=$get['rstl_id'];
        $perPage=$get['pp'];//Per page
        $Customer=new $this->modelClass;
        $dataProvider= new \yii\data\ActiveDataProvider([
            'query' => $Customer->find()->where(['rstl_id'=>$id]),
            'pagination'=>[
                'pageSize'=>$perPage
            ]
        ]);
        //$TotalPage=$dataProvider->pagination->pageCount;
        $total = $dataProvider->getTotalCount(); //total records // 15 
        $TotalPage=(int)($total/ $perPage); 
        return $total;
    }
    public function actionView(){
        $get= Yii::$app->request->get();
        $id=$get['rstl_id'];
        $Customer=new $this->modelClass;
        return new \yii\data\ActiveDataProvider([
            'query' => $Customer->find()->where(['rstl_id'=>$id]),
        ]);
    }
    public function behaviors()
    {
	return [
	    [
	        'class' => 'yii\filters\ContentNegotiator',
	        'only' => ['view', 'index'],
	        'formats' => [
	            'application/json' => Response::FORMAT_JSON,
	        ],
	    ],
            [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 86400,
                ]    
            ],
	];
    }
}
