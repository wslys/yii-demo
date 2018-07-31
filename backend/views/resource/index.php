<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ResourceListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '资源列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box wsl-page-box">
    <p>
        <?= Html::a('创建资源', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'options' => [
            'style'=>'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'level',
            'label',
            'icon',
            'url:url',
            'ctrl',
            'act',
            'disabled',
            'create_at',
            [
                'class'    => 'yii\grid\ActionColumn',
                'header'   => '是否禁用',
                'template' => '{disabled}',
                'buttons' => [
                    'disabled' => function ($url, $model, $key) {
                        return '<input class="switch switch-anim" type="checkbox" checked onclick="checkNum('.$model['id'].')">';
                    },
                ],
                'headerOptions' => ['width' => '120']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<script type="text/javascript">
    function checkNum(id){
        console.log(id);
        if($('.switch-anim').prop('checked')){
            console.log("选中");
        }else{
            console.log("没选中");
        }
    }
</script>

