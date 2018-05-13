<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 14.04.2018
 * Time: 14:37
 */
function debug($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function findBalance($profit, $decrease)
{
    $balance = $profit - $decrease;
    return $balance;
}

function findQuantity($query)
{
    $summ = 0;
    foreach ($query as $array){
        $value = $array['transaction_value'] . '<br>';
        $summ = (int)$value + $summ;
        //echo $summ . '<br>';
    }
    return $summ;
}

function goPage($url)
{
    return Yii::$app->getResponse()->redirect($url);
}