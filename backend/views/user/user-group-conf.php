<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 8/2/18
 * Time: 5:28 PM
 */
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '用户组列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box wsl-page-box">

    <?=$this->render('_user_group_conf_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('配置用户分组', ['user-group-cong-user'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'label',
            'describe',
            [
                'label' => '用户名',
                'format'=>'raw',
                'value' => function($model) {
                    return $model['username'];
                }
            ],

            [
                'class'    => 'yii\grid\ActionColumn',
                'header'   => '操作',
                'template' => '{user-group-view} {user-group-update} {user-group-delete}',
                'buttons' => [
                    'user-group-view' => function ($url, $model, $key) {
                        return  Html::a('<span class="glyphicon glyphicon-eye-open text-info"></span>', ['user-group-view', 'id' => $model['id']], ['title' => '查看'] ) ;
                    },
                    'user-group-update' => function ($url, $model, $key) {
                        return  Html::a('&nbsp;&nbsp;|&nbsp;&nbsp;<span class="glyphicon glyphicon-edit text-success"></span>', ['user-group-update', 'id' => $model['id']], ['title' => '编辑'] ) ;
                    },
                    'user-group-delete' => function ($url, $model, $key) {
                        return Html::a('&nbsp;&nbsp;|&nbsp;&nbsp;<span class="glyphicon glyphicon-trash text-danger"></span>', ['user-group-delete', 'id' => $model['id']], [
                            'data' => [
                                'confirm' => '您确定要删除 < ' . $model['label'] . ' > 吗？ ',
                                'method'  => 'post',
                            ],
                        ]);
                    },
                ],
                'headerOptions' => ['width' => '120']
            ],
        ],
    ]); ?>
</div>
