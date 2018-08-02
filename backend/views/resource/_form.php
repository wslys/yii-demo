<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ResourceList;

/* @var $this yii\web\View */
/* @var $model common\models\ResourceList */
/* @var $form yii\widgets\ActiveForm */
$one_resource = ResourceList::getOneLevel('arr');
$listData = ['' => '==请选择=='];
foreach ($one_resource as $item) {
    $listData[$item['id']] = $item['label'];
}
?>

<div class="">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'level')->dropDownList(['1' => '一级菜单', '2' => '二级菜单', '3' => '三级菜单']); ?>

    <?= $form->field($model, 'is_menu')->dropDownList(['1' => '可用于菜单', '0' => '仅用于资源']); ?>

    <?=  $form->field($model, 'parent_id')->dropDownList($listData); ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ctrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'act')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'describe')->textArea(['rows' => '3']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
