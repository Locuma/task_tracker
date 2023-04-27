<?php

namespace app\models\forms;

use app\models\TaskBoard;
use app\models\User;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

class UserSearchForm extends Model
{
    public ?int $id = null;
    public ?string $login = null;
    public ?string $first_name = null;
    public ?string $second_name = null;
    public ?string $surname = null;
    public ?int $id_role = null;

    public function rules(): array
    {
        return [
            [['login', 'first_name', 'second_name', 'surname', 'id_role'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (empty($params)){
            return $dataProvider;
        }

        $this->load($params);

        if (!$this->validate()) {

            $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($this->id_role)) {
//            VarDumper::dump($this->login); exit;
            $query->andFilterWhere(['id_role' => $this->id_role]);
        }

        if (!empty($this->login)) {
            $query->andFilterWhere(['like', 'login', $this->login]);
        }

        if (!empty($this->first_name)) {
            $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        }

        if (!empty($this->second_name)) {
            $query->andFilterWhere(['like', 'second_name', $this->second_name]);
        }

        if (!empty($this->surname)) {
            $query->andFilterWhere(['like', 'surname', $this->surname]);
        }

        return $dataProvider;
    }

    /**
     * @throws InvalidConfigException
     */
    public function load(mixed $data, $formName = null): bool
    {
        foreach ($data[$this->formName()] as $key => $value) {
            if (str_contains($key, 'id_' && !empty($value))) {

                if (empty($value)) {

                    unset($data[$this->formName()][$key]);
                } else {
                    $data[$this->formName()][$key] = (int)$value;

                }
            }
        }

        return parent::load($data, $formName);
    }
}