<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UserGroup;

$list = UserGroup::find()->asArray()->all();
$listData = ['' => '==全部=='];
foreach ($list as $item) {
    $listData[$item['id']] = $item['label'];
}
?>

<div class="user-group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['user-group-conf'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'grouplabel')->dropDownList($listData); ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
