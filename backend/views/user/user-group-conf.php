<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\UserGroup;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户分组配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box wsl-page-box">

    <?=$this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            'statusStr',
             [
                'label'=>'所属分组',
                 'format' => 'html',
                'value'=>function($model){
                    $user_group = UserGroup::getGroupByUserId($model['id']);
                    if ($user_group){
                        return $user_group['label'];
                    }
                    return '<span class="text-danger">未设置</span>';
                }
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'header'   => '配置用户分组',
                'template' => '{conf}',
                'buttons' => [
                    'conf' => function ($url, $model, $key) {
                        return '<a class="btn btn-success btn-sm" onclick="modelClick('.$model['id'].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-cog" aria-hidden="true"></i></a>';
                    }
                ],
                'headerOptions' => ['width' => '120']
            ],
        ],
    ]); ?>
</div>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">配置用户分组</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="user_id">
                    <div class="form-group">
                        <label for="disabledTextInput">请选择用户组</label>
                        <select class="form-control" id="group_id">
                            <?php foreach ($user_groups as $user_group) {?>
                                <option value="<?=$user_group['id']?>"><?=$user_group['label']?></option>
                            <?php }?>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" id="btn_submit" class="btn btn-primary">提交更改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<script type="text/javascript">
    function modelClick(user_id) {
        $('#user_id').val(user_id);
    }
    window.onload = function () {
        $('#btn_submit').click(function () {
            var user_id = $('#user_id').val();
            var group_id = $('#group_id').val();

            $.post('/user/conf-user-group', {user_id:user_id, group_id:group_id}, function (res) {
                if (!res.code) {
                    location.reload();
                }else {
                    alert(res.msg);
                }
            }, 'JSON');
        });
    }
</script>