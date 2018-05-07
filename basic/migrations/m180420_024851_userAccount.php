<?php

use yii\db\Migration;

/**
 * Class m180420_024851_userAccount
 */
class m180420_024851_userAccount extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            '{{%user_account}}',
            [
                'user_id' => $this->integer('16')->notNull(),
                'account_number' => $this->primaryKey()->comment('Primary key'),
            ]
        );

        $this->addForeignKey(
            'user_id',
            'user_account',
            'user_id',
            'user',
            'id'
        );
        $this->addForeignKey(
            'account_number',
            'user_account',
            'account_number',
            'account',
            'account_number');
    }

    public function safeDown()
    {
        echo "m180420_024851_userAccount cannot be reverted.\n";

        return false;
    }
}
