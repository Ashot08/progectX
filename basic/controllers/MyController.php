<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 14.04.2018
 * Time: 12:20
 */

namespace app\controllers;
use Yii;

class MyController extends AppController
{
    public function actionIndex()
    {

        $names = ['sema', 'bora', 'klark'];
        $hi = 'hi';

        return $this->render('index', ['hi' => $hi,'names' => $names]);
    }
}