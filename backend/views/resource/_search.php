<?php

use common\models\ResourceList;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ResourceListSearch */
/* @var $form yii\widgets\ActiveForm */
$one_resource = ResourceList::getOneLevel('arr');
$listData = ['' => '==请选择=='];
foreach ($one_resource as $item) {
    $listData[$item['id']] = $item['label'];
}
?>

<div class="">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'level')->dropDownList(['' => '==全部==', '1' => '一级资源', '2' => '二级资源', '3' => '三级资源', '4' => '四级资源']);?>

    <?= $form->field($model, 'parent_id')->dropDownList($listData); ?>

    <?= $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'ctrl') ?>

    <?php // echo $form->field($model, 'act') ?>

    <?php // echo $form->field($model, 'disabled') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div> <!-- 平衡视图 -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
