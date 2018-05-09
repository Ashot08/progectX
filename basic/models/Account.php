<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 16.04.2018
 * Time: 11:42
 */

namespace app\models;

use Faker\Provider\DateTime;
use yii\db\ActiveRecord;
use yii\base\Model;
use Yii;

class Account extends ActiveRecord
{
//    public $account_number;
//    public $opening_date;

    public static function tableName()
    {
        return 'account';
    }

    public function setAccountNumber()
    {
        $this->account_number = rand(100000000,999999999);
    }
    public function setOpeningDate()
    {
        $date = new \DateTime('NOW');
        $this->opening_date = $date->format('c');
    }

    public function getAccountNumber()
    {
        return $this->account_number;
    }
    public function getOpeningDate()
    {
        return $this->opening_date;
    }
    public function getAccountName()
    {
        return $this->accountName;
    }

    public function getAccount()
    {
        $this->setAccountNumber();
        $this->setOpeningDate();
        $this->save();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->save()) {
                $transaction->commit();
                return $this;
            }
        }catch (\Throwable $e) {
            $transaction->rollBack();
        }
    }
}