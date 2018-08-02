<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => '用户组列表', 'url' => ['user-group']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box wsl-page-box">

    <p>
        <?= Html::a('更新', ['user-group-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['user-group-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确实要删除此项吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'label',
            'describe',
            'create_at',
        ],
    ]) ?>

</div>
