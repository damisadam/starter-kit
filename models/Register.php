<?php

namespace app\models;

use Yii;
use yii\base\Security;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $role
 * @property int $status
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_reset_token
 * @property string $account_activation_token
 * @property int $created_at
 * @property int $updated_at
 */
class Register extends \yii\db\ActiveRecord
{


    public $_roles=[1=>'Admin',2=>'User',3=>'Doctor'];

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
            ['username', 'trim'],
            ['email', 'email'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['username', 'email', 'password', 'role'], 'required'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/', 'message' => 'Only Alphanumeric values(a-z,0-9). Special chracters, CAPS and empty space are not allowed.'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['auth_key'], 'string', 'max' => 32],
            [['access_token'], 'string', 'max' => 250],

            ['email', 'unique', 'targetClass' => '\app\models\Register', 'message' => 'This email address has already been taken.'],
            ['username', 'unique', 'targetClass' => '\app\models\Register', 'message' => 'This username has already been taken.'],
            [['password_reset_token'], 'unique'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'account_activation_token' => Yii::t('app', 'Account Activation Token'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function signup()
    {

        $this->updated_at=time();
        if($this->isNewRecord){
            $this->created_at=time();
            $this->status=Basic::inactive_status;
            $this->setPassword($this->password);
            $this->generateAuthKey();
        }

        return $this->save() ? $this : null;
    }

    public function sendValidationEmail($user){
       return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'activation-html', 'text' => 'activation-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName'] ])
            ->setTo($user->email)
            ->setSubject('Signup Confirmation')
            ->send();
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = time()."";
    }
    public function setPassword($password)
    {
        $this->password = md5($password);
    }
    public function getRole(){
        return $this->_roles[$this->role];
    }
    public function getRowStatus(){
    }
}
