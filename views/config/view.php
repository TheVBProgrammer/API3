<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Accesstoken */

$this->title = $model->agency->name;
$this->params['breadcrumbs'][] = ['label' => 'Accesstokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesstoken-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TokenID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TokenID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TokenID',
            'agency.name',
            'RequestToken',
            'AccessToken',
            'TokenUsed:boolean',
        ],
    ]) ?>

</div>
