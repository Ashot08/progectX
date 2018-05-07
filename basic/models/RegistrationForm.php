<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 15.04.2018
 * Time: 14:08
 */

namespace app\models;
use Yii;
use yii\base\Model;
use app\models\Account;
use yii\db\ActiveRecord;

class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'password' => 'Пароль'
        ];
    }

    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Поле обязательно для заполнения'],
            ['email', 'required', 'message' => 'Поле обязательно для заполнения'],
            ['email', 'email'],
            [
                ['username','email','password'],  'trim'
            ],
        ];
    }

    /**
     * Registers user
     *
     * @return User|null the saved model or null if saving fails
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->save() ? $user : null;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($user->save()) {

                $rbac = Yii::$app->authManager;
                $userRole = $rbac->getRole('user');

                $rbac->assign($userRole, $user->id);

    //            $account = new Account();
    //            $account->getAccount();
    //            $userAccount = new UserAccount();
    //            $userAccount->getUserAccount($user->id,$account->account_number);
                $transaction->commit();
                return $user;
            }
        }catch (\Throwable $e) {
            $transaction->rollBack();
        }
        return null;
    }
}