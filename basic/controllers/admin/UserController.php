<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 14.04.2018
 * Time: 12:49
 */
namespace app\controllers\admin;
use app\controllers\AppController;

class UserController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}