<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 21.04.2018
 * Time: 12:13
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

class AddAccount extends ActiveRecord
{
    public $accountName;
    public function rules()
    {
        return [
            ['accountName', 'required'],
            [
                ['accountName'],  'trim'
            ],
            [['accountName'], 'default' ,'value' => null],
        ];
    }

    public function addUserAccount()
    {
        $user = Yii::$app->getUser()->getId();
        $account = new Account();
        $account->account_name = $this->accountName;
        $account->getAccount();
        $userAccount = new UserAccount();

        $userAccount->getUserAccount($user,$account->account_number);
    }
}