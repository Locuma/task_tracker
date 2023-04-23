<?php

namespace app\models\forms;

use app\models\TaskBoard;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TaskBoardSearchForm extends Model
{
    public ?string $title = null;
    public ?int $id_supervisor = null;
    public ?int $id_responsible = null;
    public ?string $deadline = null;

    public function rules(): array
    {
        return [
            [['title', 'id_supervisor', 'id_responsible', 'deadline'], 'safe'],
            [['title'], 'string', 'max' => 300],
        ];
    }

    public function search($params)
    {
        $query = TaskBoard::find();

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

        if (!empty($this->title)) {
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        if (!empty($this->id_supervisor)) {
            $query->andFilterWhere(['id_supervisor' => (int)$this->id_supervisor]);
        }

        if (!empty($this->id_responsible)) {
            $query->andFilterWhere(['id_responsible' => (int)$this->id_responsible]);
        }

        if (!empty($this->deadline)) {
            $query->andFilterWhere(['deadline' => $this->deadline]);
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