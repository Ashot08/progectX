<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 08.05.2018
 * Time: 22:06
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>Transaction
<?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['transaction']]);?>
<div class="col-md-12 panel panel-default">
    <h2 class="panel panel-heading">Перевод денежных средств</h2>
    <div class="col-md-6">
        <h3>Доступные счета</h3>

        <?php
        foreach($accountNumber as $number){
            //echo $number['account_number'] . '<br>';
            //debug(\app\models\Account::find()->where(['account_number' => [$number['account_number']]])->all());
            foreach (\app\models\Account::find()->where(['account_number' => [$number['account_number']]])->all() as $name){
                ?>
                <div class="marginBottom">
                    <?php echo $name['account_name'] . ' - ' . $number['account_number'] . ' <input type ="radio" name="checkedAccount" value="'. $number['account_number'] .'"><br>';?>
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