<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '更新用户: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => '用户组列表', 'url' => ['user-group']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新用户组';
?>
<div class="box wsl-page-box">

    <?= $this->render('_user_group_form', [
        'model' => $model,
    ]) ?>

</div>
