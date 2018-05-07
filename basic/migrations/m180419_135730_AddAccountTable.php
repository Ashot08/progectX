<?php

use yii\db\Migration;

/**
 * Class m180419_135730_AddAccountTable
 */
class m180419_135730_AddAccountTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%account}}', [
            'account_number' => $this->primaryKey('16'),
            'account_name' => $this->string('48')->notNull(),
            'opening_date' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180419_135730_AddAccountTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180419_135730_AddAccountTable cannot be reverted.\n";

        return false;
    }
    */
}
