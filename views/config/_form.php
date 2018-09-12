<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Accesstoken */
/* @var $form yii\widgets\ActiveForm */
$Agency= \app\models\Agency::find()->all();
$listData=ArrayHelper::map($Agency,'agency_id','name');
?>

<div class="accesstoken-form">
    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'agency_id')->dropDownList($listData,['disabled'=>!$model->isNewRecord]) ?>
    </div>
</div>
<div class="row">    
    <div class="col-md-4">
    <?= $form->field($model, 'RequestToken')->textInput(['maxlength' => true,'disabled'=>true]) ?>
    </div>
</div>
<div class="row">     
    <div class="col-md-4">
    <?= $form->field($model, 'AccessToken')->textInput(['maxlength' => true,'disabled'=>true]) ?>
    </div>
</div>
<div class="row"> 
    <div class="col-md-4">
    <?= $form->field($model, 'TokenUsed')->checkbox(['disabled'=>true]) ?>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
