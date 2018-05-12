<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 08.05.2018
 * Time: 22:06
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['transaction']]);?>
<div class="col-md-12 panel panel-default">
    <h2 class="panel panel-heading">Перевод денежных средств</h2>
    <div class="col-md-6">
        <h3>Мои счета</h3>
        <div class="col-md-12 panel panel-heading">
            <div class="col-md-3">Имя счета</div>
            <div class="col-md-3">Номер счета</div>
            <div class="col-md-3">Баланс</div>
            <div class="col-md-3">Выбрать</div>
        </div>
        <?php
        foreach($accountNumber as $number){
            foreach (\app\models\Account::find()->where(['account_number' => [$number['account_number']]])->all() as $name){
                ?>
                <?php
                $profit = findQuantity(\app\models\Transaction::find()->where(['recipient' => [$number['account_number']]])->all());
                $decrease = findQuantity(\app\models\Transaction::find()->where(['account_number' => [$number['account_number']]])->all());
                $balance = findBalance($profit, $decrease);
                ?>
                <div class="marginBottom col-md-12">
                    <?php echo '<div class="col-md-3"><strong>' . $name['account_name'] . '</strong></div> 
                    <div class="col-md-3">' . $number['account_number'] . '</div>
                    <div class="col-md-3">' . $balance . '</div> 
                    <div class="col-md-3"><input type ="radio" name="checkedAccount" value="'. $number['account_number'] . '"></div>';?>
                </div>
                <?php
            }
        }?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'transaction_value')->input('text', ['placeholder'=>'Сумма перевода', 'name'=>'transaction_value'])?>
        <?= $form->field($model, 'recipient')->input('text', ['placeholder'=>'Номер счета получателя', 'name'=>'recipient'])?>
        <?= Html::submitInput('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

</div>
<?php ActiveForm::end(); ?>
<?php
//debug($_POST);
?>