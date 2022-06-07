<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\AccessControl;

/**
 * This is the model class for table "user".
 *
 * @property int $id id
 * @property string $role Роль
 * @property string $login Логін
 * @property string $pass Пароль
 * @property string $auth_key Ключ авторизації
 * @property integer $creat_at Час створення
 * @property integer $updat_at Час останнього оновлення
 * @property string $f_name Ім\'я
 * @property string $l_name Фамілія
 * @property string|null $age Дата народження
 * @property string|null $position Посада
 * @property string|null $email Електронна адреса
 * @property string|null $phone Номер телефону
 * @property int|null $type_zp Тип ЗП (0 - ставка, 1 - погодинно, 2 - ставка+погодинно)
 * @property float|null $zp_h ЗП на годину
 * @property int $id_group id групи
 * @property int $status Статус
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                TimestampBehavior::className(),
            ];
        }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['role', 'login', 'pass', 'f_name', 'l_name', 'id_group', 'status'], 'required'],
            [['age'], 'safe'],
            [['type_zp', 'id_group', 'status', 'created_at', 'updated_at'], 'integer'],
            [['zp_h'], 'number'],
            [['phone'], 'string', 'max' => 13],
            [['role'], 'string', 'max' => 16],
            [['login', 'pass', 'position', 'email'], 'string', 'max' => 32],
            [['f_name', 'l_name'], 'string', 'max' => 64],
            [['login'], 'unique'],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($pass)
    {
        return Yii::$app->security->validatePassword($pass, $this->pass);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($pass)
    {
        $this->pass = Yii::$app->security->generatePasswordHash($pass);
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Доступ',
            'login' => 'Логін',
            //'pass' => 'Pass',
            'f_name' => 'Ім\'я',
            'l_name' => 'Фамілія',
            'age' => 'Дата народження',
            'position' => 'Посада',
            'email' => 'E-mail',
            'phone' => 'Номер телефону',
            'type_zp' => 'Тип заробітної плати',
            'zp_h' => 'Заробітня плата на годину',
            'id_group' => 'Група',
            //'status' => 'Status',
        ];
    }
}
