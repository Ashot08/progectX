<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 08.05.2018
 * Time: 16:33
 */

namespace app\models;


use Faker\Provider\DateTime;
use yii\db\ActiveRecord;
use Yii;

class Transaction extends ActiveRecord
{
//    public $transaction_value;
//    public $recipient;

    public static function tableName()
    {
        return 'transaction';
    }

    public function rules()
    {
        return [
            ['recipient', 'required'],
            ['transaction_value', 'required'],
            [
                ['recipient', 'transaction_value'],  'trim'
            ],
        ];
    }

    public function transact($accountNumber, $recipient, $transactionValue, $transactionType)
    {
        $date = new \DateTime('NOW');
        //$newTransaction = new Transaction();

        $this->account_number = $accountNumber;
        $this->recipient = $recipient;
        $this->transaction_value = $transactionValue;
        $this->transaction_type = $transactionType;
        $this->date = $date->format('c');

        $this->save();
    }
}