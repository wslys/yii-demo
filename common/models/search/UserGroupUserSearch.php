<?php

namespace common\models\search;

use common\models\UserGroup;
use common\models\UserGroupUser;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ResourceList;
use yii\db\Query;

/**
 * ResourceListSearch represents the model behind the search form of `common\models\ResourceList`.
 */
class UserGroupUserSearch extends UserGroupUser
{
    public $grouplabel;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user_grout_id'], 'required'],
            [['user_id', 'user_grout_id'], 'integer'],
            ['grouplabel', 'string'],
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
            'label' => '名称',
            'describe' => '描述',
            'grouplabel' => '用户组',
            'create_at' => '创建时间',
        ];
    }

    public function getGrouplabel() {
        return $this->grouplabel;
    }
    public function setGrouplabel($grouplabel) {
        $this->grouplabel = $grouplabel;
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query =  (new Query())
            ->select(['u.id AS user_id', 'u.username', 'ug.*'])
            ->from('user_group ug')
            ->leftJoin('user_group_user ugu', 'ug.id=ugu.user_grout_id')
            ->leftJoin('user u', 'ugu.user_id=u.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_group.id' => $this->grouplabel,
        ]);

        return $dataProvider;
    }
}
