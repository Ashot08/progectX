<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
?>
<h2>Отправьте, пжлста, форму</h2>
<?php
    //debug($_POST);
?>
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

<?php $form = ActiveForm::begin(['options' => ['method' => 'post']]);?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= Html::submitButton('send', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
