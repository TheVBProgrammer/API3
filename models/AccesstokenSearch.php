<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Accesstoken;

/**
 * AccesstokenSearch represents the model behind the search form about `app\models\Accesstoken`.
 */
class AccesstokenSearch extends Accesstoken
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TokenID', 'agency_id', 'TokenUsed'], 'integer'],
            [['RequestToken', 'AccessToken','RSTLName'], 'safe'],
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
        $query = Accesstoken::find()->joinWith(['agency']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
        ]);
        $dataProvider->sort->attributes['RSTLName'] = [
            'asc' => ['rstl.name' => SORT_ASC],
            'desc' => ['rstl.name' => SORT_DESC],
        ];
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'TokenID' => $this->TokenID,
            'TokenUsed' => $this->TokenUsed,
        ]);

        $query->andFilterWhere(['like', 'RequestToken', $this->RequestToken])
            ->andFilterWhere(['like', 'AccessToken', $this->AccessToken])
            ->andFilterWhere(['like', 'rstl.name', $this->RSTLName]);

        return $dataProvider;
    }
}
