<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $date_of_birth
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'username'], 'required'],
            [['password', 'username'], 'string', 'min' => 6],
            [['date_of_birth'], 'safe'],
            [['username', 'password', 'email'], 'string', 'max' => 64],
            [['username'], 'unique'],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'date_of_birth' => 'Date Of Birth',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($insert) {
            $user = Users::findOne(['id' => $this->id]);
            $salt = new Salt();
            $salt->value = Yii::$app->security->generateRandomString(10);
            $salt->user_id = $user->id;
            $salt->save();
            Yii::$app->security->kdfHash = 'sha512';
            $user->password = Yii::$app->security->generatePasswordHash($this->password . $salt->value);
            $user->save();
        }
    }
}
