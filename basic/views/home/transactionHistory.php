<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 13.05.2018
 * Time: 12:08
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h2>Исходящие платежи</h2>

<div class="col-md-12 panel panel-default">
    <div class="col-xs-12 panel panel-primary">
        <div class="col-xs-4">Номер счета</div>
        <div class="col-xs-4">Сумма перевода</div>
        <div class="col-xs-4">Дата и время</div>
    </div>
    <?php
    foreach($accountNumber as $number){
        foreach (\app\models\Transaction::find()->where(['account_number' => [$number['account_number']]])->all() as $name){
        ?>
        <div class="marginBottom col-xs-12">
            <?php echo '<div class="col-xs-4"><strong>' . $name['account_number'] . '</strong></div> 
                        <div class="col-xs-4">' . $name['transaction_value'] . '</div>
                        <div class="col-xs-4">' . $name['date'] . '</div> 
            </div>';
        }
    }
    ?>
</div>

<h2>Входящие платежи</h2>
<div class="col-md-12 panel panel-default">
    <div class="col-xs-12 panel panel-primary">
        <div class="col-xs-4">Номер счета</div>
        <div class="col-xs-4">Сумма перевода</div>
        <div class="col-xs-4">Дата и время</div>
    </div>
    <?php
    foreach($accountNumber as $number){
    foreach (\app\models\Transaction::find()->where(['recipient' => [$number['account_number']]])->all() as $name){
        $comment = '';
        if($name['account_number'] === 0){
            $comment = ' (пополнение счета)';
        }
        else{
            $comment = ' (от ' . $name['account_number'] . ')';
        }
    ?>
    <div class="marginBottom col-xs-12">
        <?php echo '<div class="col-xs-4"><strong>' . $name['recipient'] . '</strong>' . $comment . '</div> 
                        <div class="col-xs-4">' . $name['transaction_value'] . '</div>
                        <div class="col-xs-4">' . $name['date'] . '</div> 
            </div>';
        }
        }
        ?>
</div>