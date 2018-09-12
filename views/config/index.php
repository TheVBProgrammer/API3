<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccesstokenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configurations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesstoken-index">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Access Tokens</div>
        <div class="panel-body">
            <div class="table-responsive">
            <p>
                <?= Html::a('Create Accesstoken', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header' => 'RSTL',
                        'attribute' => 'RSTLName',
                        'value' => function($model, $key, $index) {
                            return $model->agency->name;
                        },
                    ],
                    'RequestToken',
                    'AccessToken',
                    'TokenUsed:boolean',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
            </div>
        </div>
    </div>
</div>
