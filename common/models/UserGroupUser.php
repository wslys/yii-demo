<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_group_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_grout_id
 * @property string $create_at
 */
class UserGroupUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_group_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user_grout_id'], 'required'],
            [['user_id', 'user_grout_id'], 'integer'],
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
            'user_id' => 'User ID',
            'user_grout_id' => 'User Grout ID',
            'create_at' => 'Create At',
        ];
    }
}
