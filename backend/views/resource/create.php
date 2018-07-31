<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ResourceList */

$this->title = '创建资源';
$this->params['breadcrumbs'][] = ['label' => '资源列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box wsl-page-box">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
