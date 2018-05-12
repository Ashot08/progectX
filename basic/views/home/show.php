<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<h1>Управление счетами</h1>
<?php if (Yii::$app->session->hasFlash('success')):?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success');?>
    </div>
<?php endif?>
<?php if (Yii::$app->session->hasFlash('error')):?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Ошибка!</strong> <?php echo Yii::$app->session->getFlash('error');?>
    </div>
<?php endif?>
    <div class="col-md-6 col-md-push-6 text-center">
        <ul>
            <li class="panel panel-heading"><a href="<?php echo Url::to(['home/transaction'])?>">Переводы</a></li>
            <li class="panel panel-heading"><a href="<?php echo Url::to(['home/deposit'])?>">Пополнить счет</a></li>
            <li class="panel panel-heading"><a href="#">История транзакций</a></li>
            <li class="panel panel-heading"><a href="#">Справочная информация</a></li>
        </ul>
    </div>
<div class="col-md-6 col-md-pull-6 panel panel-default">
    <h2 class="panel panel-heading">Открыть счет</h2>
    <?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['show']]);?>
    <?= $form->field($model, 'accountName')->input('text', ['placeholder'=>'Введите имя нового счета'])?>
    <?= Html::submitInput('Открыть счет', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>

<div class="col-md-12 panel panel-default">
    <?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['show']]);?>
        <h2 class="panel panel-heading">Доступные счета</h2>
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
    <div class="marginBottom">
        <?= Html::submitInput('Удалить счет', ['class' => 'btn btn-success', 'name' => 'delete']) ?>
    </div>

    <p class="panel-footer">
        Вы вправе содержать не более 5 счетов
    </p>
    <?php ActiveForm::end(); ?>
</div>

<?php

//if(!empty($_POST['delete']) && !empty($_POST['checkedAccount'])){
//    debug($_POST['checkedAccount']);
//}
?>