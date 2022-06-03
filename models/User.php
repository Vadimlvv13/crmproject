<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id id
 * @property string $role Роль
 * @property string $login Логін
 * @property string $pass Пароль
 * @property string $name ПІБ
 * @property string|null $age Дата народження
 * @property string|null $position Посада
 * @property int|null $type_zp Тип ЗП (0 - ставка, 1 - погодинно, 2 - ставка+погодинно)
 * @property float|null $zp_h ЗП на годину
 * @property int $id_group id групи
 * @property int $status Статус
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'login', 'pass', 'name', 'id_group', 'status'], 'required'],
            [['age'], 'safe'],
            [['type_zp', 'id_group', 'status'], 'integer'],
            [['zp_h'], 'number'],
            [['role'], 'string', 'max' => 16],
            [['login', 'pass', 'position'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 64],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'login' => 'Login',
            'pass' => 'Pass',
            'name' => 'Name',
            'age' => 'Age',
            'position' => 'Position',
            'type_zp' => 'Type Zp',
            'zp_h' => 'Zp H',
            'id_group' => 'Id Group',
            'status' => 'Status',
        ];
    }
}
