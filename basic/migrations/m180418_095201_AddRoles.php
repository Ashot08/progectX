<?php

use yii\db\Migration;

/**
 * Class m180418_095201_AddRoles
 */
class m180418_095201_AddRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $rbac = \Yii::$app->authManager;

        $guest = $rbac->createRole('guest');
        $guest->description = 'Незарегистрированный посетитель';
        $rbac->add($guest);

        $user = $rbac->createRole('user');
        $user->description = 'Пользователь';
        $rbac->add($user);

        $admin = $rbac->createRole('admin');
        $admin->description = 'Админ';
        $rbac->add($admin);

        $rbac->addChild($admin, $user);
        $rbac->addChild($user, $guest);

//        $rbac->assign(
//            $admin,
//            \app\models\User::findOne([
//                'username' => 'admin'])->id
//        );
        $watchShow = $rbac->createPermission('watch show');
        $watchShow->description = 'просмотр страницы Show';
        $rbac->add($watchShow);
        $rbac->addChild($user, $watchShow);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180418_095201_AddRoles cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180418_095201_AddRoles cannot be reverted.\n";

        return false;
    }
    */
}
