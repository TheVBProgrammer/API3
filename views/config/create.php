<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accesstoken */

$this->title = 'Create Accesstoken';
$this->params['breadcrumbs'][] = ['label' => 'Accesstokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesstoken-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
