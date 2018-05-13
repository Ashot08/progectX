<?php
/**
 * Created by PhpStorm.
 * User: Ashot08
 * Date: 14.04.2018
 * Time: 12:10
 */

namespace app\controllers;
use app\models\Account;
use app\models\AddAccount;
use app\models\Transaction;
use app\models\UserAccount;
use Yii;
use app\models\RegistrationForm;
use app\models\User;
use yii\helpers\Url;

class HomeController extends AppController
{
    //public $layout = 'basic';

    public function actionIndex()
    {
        $model = new RegistrationForm();
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                if ($user = $model->register()) {
                    if (Yii::$app->getUser()->login($user)) {
                        Yii::$app->session->setFlash('success', 'Пользователь успешно зарегистрирован');
                        return $this->goHome();
                    }
                }
            }
            else{
                Yii::$app->session->setFlash('error', 'Ошибка, проверьте правильность заполнения форм');
            }
        }
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else{
            return $this->render('index', compact('model'));
        }
    }

    public function actionShow()
    {
        $model = new addAccount();
        $user = Yii::$app->getUser()->getId();
        $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->one()['account_number'];

        if (!\Yii::$app->user->can('watch show')) {
            Yii::$app->session->setFlash('success', 'Ты не юзер, и уж явно не админ');
            return $this->goBack();
        }
        else{
            $user = Yii::$app->getUser()->getId();
            $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->all();

            if($model->load(Yii::$app->request->post())) {
                if ($model->validate($model->accountName) && empty($_POST['delete']) && count($accountNumber) < 5) {
                    $model->addUserAccount();
                    Yii::$app->session->setFlash('success', 'Счет успешно зарегистрирован');
                    $this->refresh();
                }
                else {
//                    Yii::$app->session->setFlash('error', 'Ошибка, проверьте правильность заполнения форм');
                }
            }
            if (!empty($_POST['delete'])&&!empty($_POST['checkedAccount'])){
                $userAccount = UserAccount::find()->where(['account_number' => $_POST['checkedAccount']])->one();
                $account = Account::find()->where(['account_number' => $_POST['checkedAccount']])->one();

                $userAccount->delete();
                $account->delete();
                $this->refresh();
            }
        }
        return $this->render('show', compact('accountNumber', 'model', 'user'));
    }

    public function actionTransaction()
    {
        if (!\Yii::$app->user->can('watch show')) {
            Yii::$app->session->setFlash('success', 'Ты не юзер, и уж явно не админ');
            return $this->goBack();
        }
        else{
            $user = Yii::$app->getUser()->getId();
            $model = new Transaction();
            $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->all();
            $recipient = UserAccount::find()->where(['account_number' => [$_POST['recipient']?? null]])->one();

            $profit = findQuantity(Transaction::find()->where(['recipient' => [$_POST['checkedAccount'] ?? null]])->all());
            $decrease = findQuantity(Transaction::find()->where(['account_number' => [$_POST['checkedAccount'] ?? null]])->all());
            $balance = findBalance($profit, $decrease);

            if($recipient && !empty($_POST['transaction_value']) && $balance >= $_POST['transaction_value'] && !empty($_POST['checkedAccount'])) {
                    $model->transact( $_POST['checkedAccount'], $_POST['recipient'], $_POST['transaction_value'], true);
                    $this->refresh();
                Yii::$app->session->setFlash('success', 'Перевод выполнен успешно');
                return goPage(Url::to(['home/transaction']));
            }
            elseif (!empty($_POST) && !$recipient){
                Yii::$app->session->setFlash('error', 'Ошибка, счет получателя не существует');
                return goPage(Url::to(['home/transaction']));
            }
            elseif(!empty($_POST) && (empty($_POST['checkedAccount']) || empty($_POST['transaction_value']))){
                Yii::$app->session->setFlash('error', 'Ошибка, не выбран счет или не заполнены поля');
                return goPage(Url::to(['home/transaction']));
                }
            else{
                //
            }
        }
        return $this->render('transaction' , compact('accountNumber', 'model'));
    }

    public function actionDeposit()
    {
        $user = Yii::$app->getUser()->getId();
        $model = new Transaction();
        $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->all();
        if(!empty($_POST['deposit_value']) && !empty($_POST['checkedAccount'])) {
            $model->transact( 0,  $_POST['checkedAccount'], $_POST['deposit_value'], true);
            $this->refresh();
            Yii::$app->session->setFlash('success', 'Платеж принят');
            return goPage(Url::to(['home/deposit']));
        }
        elseif(!empty($_POST) && (empty($_POST['deposit_value']) || empty($_POST['checkedAccount']))){
            Yii::$app->session->setFlash('error', 'Ошибка, проверьте правильность ввода данных');
            return goPage(Url::to(['home/deposit']));
        }
        else{
            //
        }
        return $this->render('deposit', compact('accountNumber', 'model'));
    }
    public function actionTransactionHistory()
    {
        if (!\Yii::$app->user->can('watch show')) {
            Yii::$app->session->setFlash('success', 'Ты не юзер, и уж явно не админ');
            return $this->goBack();
        }
        else {
            $user = Yii::$app->getUser()->getId();
            $model = new Transaction();
            $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->all();
            return $this->render('transactionHistory', compact('accountNumber', 'model'));
        }
    }
}