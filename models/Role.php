<?php

namespace app\models;

use yii\db\ActiveRecord;
use \yii\db\ActiveQuery;

class Role extends ActiveRecord
{
    /**
     * @property int $id
     * @property string $name
     */

    public static function tableName(): string
    {
        return '{{%role}}';
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasMany(User::class, ['id_role' => 'id']);
    }
}