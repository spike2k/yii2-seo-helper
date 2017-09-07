<?php

namespace warsztatweb\seo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use warsztatweb\seo\models\SeoMeta;

/**
 * SeoMetaSearch represents the model behind the search form about `warsztatweb\seo\models\SeoMeta`.
 */
class SeoMetaSearch extends SeoMeta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'robots'], 'integer'],
            [['route', 'params', 'title', 'metakeys', 'metadesc', 'tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = SeoMeta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'robots' => $this->robots,
        ]);

        $query->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'metakeys', $this->metakeys])
            ->andFilterWhere(['like', 'metadesc', $this->metadesc])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
