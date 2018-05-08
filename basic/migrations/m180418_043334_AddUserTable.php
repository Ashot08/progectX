<?php

use yii\db\Migration;

/**
 * Class m180418_043334_AddUserTable
 */
class m180418_043334_AddUserTable extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->comment('Primary key'),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->string()->notNull()->defaultValue(app\models\User::STATUS_ACTIVE)
            ]);
    }

    public function safeDown()
    {
        echo "m180418_043334_AddUserTable cannot be reverted.\n";

        return false;
    }
}
