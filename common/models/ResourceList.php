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
 * @property string $describe
 * @property int $is_menu
 * @property string $create_at
 */
class ResourceList extends \yii\db\ActiveRecord
{
    const DISABLED_DELETED = 0;
    const DISABLED_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'disabled', 'parent_id'], 'integer'],
            [['create_at'], 'safe'],
            ['is_menu', 'default', 'value'  => 0],
            ['describe', 'string'],
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
            'label' => '资源名称', // 资源(菜单)标签
            'icon' => '图标',  // 资源(菜单)图标
            'url' => '地址',   // 资源(菜单)地址
            'ctrl' => '控制器',// 资源控制器
            'act' => 'Action',// 资源Action
            'disabled' => '是否禁用', // 是否禁用
            'describe' => '资源描述', // 是否禁用
            'is_menu' => '用作菜单', // 是否禁用
            'parent_id' => '上级资源', // 是否禁用
            'create_at' => '创建时间', // 创建时间
        ];
    }

    /**
     * 获取一级资源（菜单）
     * @param string $type
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getOneLevel($type='obj') {
        $levels = self::find()->where(['level'=>1]);
        if ($type != 'obj') {
            $levels->asArray();
        }
        return $levels->all();
    }

    /**
     * 获取菜单
     * @return array
     */
    public static function  LeftMenu () {
        $lists = ResourceList::find()->where(['is_menu'=>1])->asArray()->orderBy('level, parent_id')->all();
        $list_menu = [];
        foreach ($lists as $item) {
            $id = $item['id'];
            $parent_id = $item['parent_id'];

            if (!$parent_id) {
                $list_menu[$id] = $item;
            }else {
                if (!isset($list_menu[$parent_id]['items']))
                    $list_menu[$parent_id]['items'] = [];

                $list_menu[$parent_id]['items'][$id] = $item;
            }
        }

        $menus = [['label' => '菜单按钮', 'options' => ['class' => 'header']],];
        foreach ($list_menu as $item) {
            $menu = [
                'label' => $item['label'],
                'icon' => $item['icon'],
                'url' => $item['url'],
                'items' => []
            ];
            if (count($item['items']) > 0) {
                foreach ($item['items'] as $_item) {
                    $menu['items'][] = [
                        'label' => $_item['label'],
                        'icon' => $_item['icon'],
                        'url' => [$_item['url']]
                    ];
                }
            }
            $menus[] = $menu;
        }

        return $menus;
    }
}
