<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 20.04.2018
 * Time: 10:21
 */

namespace app\models;


use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class UserAccount extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_account';
    }
    public function getUserAccount($user, $account)
    {
        $userAccount = new UserAccount();
        $userAccount->user_id = $user;
        $userAccount->account_number = $account;

        $userAccount->save();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($userAccount->save()) {
                $transaction->commit();
                return $userAccount;
            }
        }catch (\Throwable $e) {
            $transaction->rollBack();
        }
        return null;
    }
}