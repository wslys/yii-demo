<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ResourceList;

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
            [
                'label' => '资源图标',
                'format'=>'raw',
                'value' => function($model) {
                    return '<i class="fa fa-'.$model['icon'].'" aria-hidden="true"></i>';
                }
            ],
            'label',
            [
                'label' => '资源级别',
                'format'=>'raw',
                'value' => function($model) {
                    $level_arr = ['一级菜单', '二级菜单', '三级菜单'];
                    return $level_arr[($model['level'] - 1)];
                }
            ],
            [
                'label' => '上级资源',
                'format'=>'raw',
                'value' => function($model) {
                    $resource = ResourceList::findOne($model['parent_id']);
                    if ($resource) {
                        return $resource->label;
                    }
                    return $model['parent_id'];
                }
            ],
            'url:url',
            //'ctrl',
            //'act',
            [
                'label' => '资源状态',
                'format'=>'raw',
                'value' => function($model)
                {
                    if ($model['disabled'] == \common\models\ResourceList::DISABLED_ACTIVE) {
                        return '<span class="text-success">使用中</span>';
                    }else {
                        return '<span class="text-danger">(已禁用)</span>';
                    }
                }
            ],
            [
                'label' => '用作菜单',
                'format'=>'raw',
                'value' => function($model) {
                    if ($model['is_menu']) {
                        return '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>';
                    }
                    return '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                }
            ],
            //'create_at',
            [
                'class'    => 'yii\grid\ActionColumn',
                'header'   => '是否禁用',
                'template' => '{disabled}',
                'buttons' => [
                    'disabled' => function ($url, $model, $key) {
                        $disabled = 1;
                        if ($model['disabled']) {
                            $disabled = 0;
                        }
                        return '<input class="switch switch-anim" type="checkbox" '.($model['disabled']?'checked':'').' onclick="checkNum('.$model['id'].', '.$disabled.')">';
                    },
                ],
                'headerOptions' => ['width' => '120']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<script type="text/javascript">
    function checkNum(id, disabled){
        $.get('/resource/prohibit-resource', {id:id, disabled:disabled}, function (res) {
            if (!res.code) {
               window.location.reload();
            }else {
                alert(res.msg);
            }
        }, 'JSON');

    }
</script>

