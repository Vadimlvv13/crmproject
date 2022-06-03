<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id id
 * @property int|null $id_project id проекту
 * @property int $t_create Час створення задачі
 * @property int|null $t_start Час початку рушення задачі
 * @property int|null $t_stop Час закінчення рішення задачі
 * @property int|null $t_limit Час ліміт задачі
 * @property int $id_manager id Користувача, що створив задачу
 * @property int $id_user id Користувача
 * @property string|null $comment Коментар
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 't_create', 't_start', 't_stop', 't_limit', 'id_manager', 'id_user'], 'integer'],
            [['t_create', 'id_manager', 'id_user'], 'required'],
            [['comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_project' => 'Id Project',
            't_create' => 'T Create',
            't_start' => 'T Start',
            't_stop' => 'T Stop',
            't_limit' => 'T Limit',
            'id_manager' => 'Id Manager',
            'id_user' => 'Id User',
            'comment' => 'Comment',
        ];
    }
}
