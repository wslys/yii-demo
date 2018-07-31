<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resource_list".
 *
 * @property int $id
 * @property int $level
 * @property string $label
 * @property string $icon
 * @property string $url
 * @property string $ctrl
 * @property string $act
 * @property int $disabled
 * @property int $parent_id
 * @property string $create_at
 */
class ResourceList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'disabled', 'parent_id'], 'integer'],
            [['create_at'], 'safe'],
            [['label', 'icon', 'url', 'ctrl', 'act'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'level' => '等级', // 资源(菜单)等级
            'label' => '标签', // 资源(菜单)标签
            'icon' => '图标',  // 资源(菜单)图标
            'url' => '地址',   // 资源(菜单)地址
            'ctrl' => '控制器',// 资源控制器
            'act' => 'Action',// 资源Action
            'disabled' => '是否禁用', // 是否禁用
            'create_at' => '创建时间', // 创建时间
        ];
    }
}
