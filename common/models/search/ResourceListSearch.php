<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ResourceList;

/**
 * ResourceListSearch represents the model behind the search form of `common\models\ResourceList`.
 */
class ResourceListSearch extends ResourceList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level', 'disabled', 'parent_id'], 'integer'],
            [['label', 'icon', 'url', 'ctrl', 'act', 'create_at'], 'safe'],
        ];
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ResourceList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
            'parent_id' => $this->parent_id,
            'disabled' => $this->disabled,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'ctrl', $this->ctrl])
            ->andFilterWhere(['like', 'act', $this->act]);

        return $dataProvider;
    }
}
