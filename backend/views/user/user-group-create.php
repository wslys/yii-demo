<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '创建用户组';
$this->params['breadcrumbs'][] = ['label' => '用户组列表', 'url' => ['user-group']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_user_group_form', [
        'model' => $model,
    ]) ?>

</div>
