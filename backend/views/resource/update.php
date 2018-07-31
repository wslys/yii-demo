<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ResourceList */

$this->title = '更新资源: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => '资源列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="box wsl-page-box">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
