<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h1>Show action</h1>
<?php echo '<h2>Это видит только User</h2>';?>

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
<?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['show']]);?>
<?= $form->field($model, 'accountName')->input('text', ['placeholder'=>'Введите имя аккаунта'])?>
<?= Html::submitInput('Открыть счет', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['show']]);?>
<?= Html::submitInput('Удалить счет', ['class' => 'btn btn-success', 'name' => 'delete']) ?>
<?php

foreach($accountNumber as $number){
    //echo $number['account_number'] . '<br>';
    //debug(\app\models\Account::find()->where(['account_number' => [$number['account_number']]])->all());
    foreach (\app\models\Account::find()->where(['account_number' => [$number['account_number']]])->all() as $name){
        ?>
        <div>
            <?php echo $name['account_name'] . ' - ' . $number['account_number'] . ' <input type ="radio" name="checkedAccount" value="'. $number['account_number'] .'"><br>';?>
        </div>

        <?php
    }
}?>
<?php ActiveForm::end(); ?>
<?php

//if(!empty($_POST['delete']) && !empty($_POST['checkedAccount'])){
//    debug($_POST['checkedAccount']);
//}

?>