<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accesstoken */

$this->title = 'Update Accesstoken: ' . $model->agency->name;
$this->params['breadcrumbs'][] = ['label' => 'Accesstokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TokenID, 'url' => ['view', 'id' => $model->TokenID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accesstoken-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
