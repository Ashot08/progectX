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
use app\models\UserAccount;
use Yii;
use app\models\RegistrationForm;
use app\models\User;

class PostController extends AppController
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
                        //return $this->render('index');
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

//    public function actionShow()
//    {
//        $model = new RegistrationForm();
//        $user = Yii::$app->getUser()->getId();
//        $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->one()['account_number'];
//
////        if (!\Yii::$app->user->can('watch show')) {
////            Yii::$app->session->setFlash('success', 'Ты не юзер, и уж явно не админ');
////            return $this->goBack();
////        }
////        else{
////            $user = Yii::$app->getUser()->getId();
////            $accountNumber = UserAccount::find()->where(['user_id' => [$user]])->one()['account_number'];
////
////            return $this->render('show', compact('accountNumber'));
////        }
//
//        if(!\Yii::$app->user->can('watch show')){
//            Yii::$app->session->setFlash('success', 'Ты не юзер, и уж явно не админ');
//            return $this->goBack();
//        }
//        else{
//            return $this->render('show', compact('accountNumber', $model));
//        }
//    }
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
                if ($model->validate($model->accountName) && empty($_POST['delete'])) {
                    $model->addUserAccount();
                    Yii::$app->session->setFlash('success', 'Счет успешно зарегистрирован');
                    $this->refresh();
                }
                else {
//                    Yii::$app->session->setFlash('error', 'Ошибка, проверьте правильность заполнения форм');
                }
                //return $this->render('show', compact('accountNumber', 'model'));
            }
            if (!empty($_POST['delete'])&&!empty($_POST['checkedAccount'])){
                $userAccount = UserAccount::find()->where(['account_number' => $_POST['checkedAccount']])->one();
                $account = Account::find()->where(['account_number' => $_POST['checkedAccount']])->one();
                $userAccount->delete();
                $account->delete();
                //return $this->goHome();
            }
        }
        return $this->render('show', compact('accountNumber', 'model', 'user'));


//        if(!\Yii::$app->user->can('watch show')){
//            Yii::$app->session->setFlash('success', 'Ты не юзер, и уж явно не админ');
//            return $this->goBack();
//        }
//        else{
//            return $this->render('show', compact('accountNumber', $model));
//        }
    }
}