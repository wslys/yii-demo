<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "user_group_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $grout_id
 * @property string $create_at
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'grout_id'], 'required'],
            [['user_id', 'grout_id'], 'integer'],
            [['create_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'grout_id' => '用户分组ID',
            'create_at' => '创建时间',
        ];
    }

    /**
     * 获取用户所属分组
     * @param $user_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getGroupByUserId($user_id){
        $query = (new Query())->select([])
            ->from('user_group ug')
            ->leftJoin('group g', 'ug.grout_id=g.id')
            ->where(['ug.user_id'=>$user_id])
            ->one();
        return $query;
    }
}
