<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Thread;

/**
 * ThreadSearch represents the model behind the search form about `common\models\Thread`.
 */
class ThreadSearch extends Thread
{
    public function rules()
    {
        return [
            [['id', 'board_id', 'user_id', 'views', 'posts', 'status'], 'integer'],
            [['user_name', 'title', 'create_time', 'modify_time', 'note1', 'note2'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Thread::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'board_id' => $this->board_id,
            'user_id' => $this->user_id,
            'create_time' => $this->create_time,
            'modify_time' => $this->modify_time,
            'views' => $this->views,
            'posts' => $this->posts,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'note1', $this->note1])
            ->andFilterWhere(['like', 'note2', $this->note2]);

        return $dataProvider;
    }
}
