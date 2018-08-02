<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_group_res".
 *
 * @property int $id
 * @property int $res_id
 * @property int $user_group_id
 * @property string $create_at
 */
class UserGroupRes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_group_res';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['res_id', 'user_group_id'], 'required'],
            [['res_id', 'user_group_id'], 'integer'],
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
            'res_id' => 'Res ID',
            'user_group_id' => 'User Group ID',
            'create_at' => 'Create At',
        ];
    }
}
