<?php

use yii\db\Migration;

/**
 * Class m180508_082243_addTransactionTable
 */
class m180508_082243_addTransactionTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%transaction}}',
            [
                'transaction_number' => $this->primaryKey()->comment('Primary key'),
                'account_number' => $this->integer('16'),
                'recipient' => $this->integer('16'),
                'transaction_type' => $this->boolean(),
                'transaction_value' => $this->integer()->notNull(),
                'date' => $this->dateTime()
            ]
        );
//        $this->addForeignKey(
//            'account_number',
//            'transaction',
//            'account_number',
//            'account',
//            'account_number');
//
//        $this->addForeignKey(
//            'recipient',
//            'transaction',
//            'recipient',
//            'account',
//            'account_number');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180508_082243_addTransactionTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180508_082243_addTransactionTable cannot be reverted.\n";

        return false;
    }
    */
}
