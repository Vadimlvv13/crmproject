<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id id
 * @property int $id_user id Користувача
 * @property int|null $id_task id Задачі
 * @property int $time Час створення
 * @property string $text Текст коментара
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'time', 'text'], 'required'],
            [['id_user', 'id_task', 'time'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_task' => 'Id Task',
            'time' => 'Time',
            'text' => 'Text',
        ];
    }
}
