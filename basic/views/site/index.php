<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'projectX';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p class="lead">You'll have success.</p>

        <?php if (Yii::$app->user->isGuest):?>
            <?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['login']]);?>
            <?= Html::submitInput('Войти', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        <?php endif;?>
        <?php if (!Yii::$app->user->isGuest):?>
            <?php $form = ActiveForm::begin(['options' => ['method' => 'post'], 'action' => ['home/show']]);?>
            <?= Html::submitInput('Домой', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        <?php endif;?>

    </div>

    <div class="body-content">

        <div class="row">

            <!--//...-->

        </div>

    </div>
</div>
