<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 14.04.2018
 * Time: 13:25
 */

namespace app\controllers;

use yii\web\Controller;

class AppController extends Controller
{
    public function debug($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }
}