<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RstlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rstls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rstl-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rstl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'region_id',
            'name',
            'code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
