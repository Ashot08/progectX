<?php

use yii\db\Migration;

/**
 * Class m180418_095201_AddRoles
 */
class m180418_095201_AddRoles extends Migration
{
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

        $watchShow = $rbac->createPermission('watch show');
        $watchShow->description = 'просмотр страницы Show';
        $rbac->add($watchShow);
        $rbac->addChild($user, $watchShow);

    }

    public function safeDown()
    {
        echo "m180418_095201_AddRoles cannot be reverted.\n";

        return true;
    }
}
