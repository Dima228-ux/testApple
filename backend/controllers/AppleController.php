<?php


namespace backend\controllers;


use common\models\Apple;
use common\models\AppleForm;
use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\HttpException;

class AppleController extends BasickController
{
    public function actionGetApples()
    {
        $this->view->title = 'Apples';

        $model = new AppleForm(new Apple());
        $apples = Apple::find()->all();

        return $this->render('index', ['apples' => $apples, 'model' => $model]);
    }

    public function actionGenApples()
    {
        $apple = new AppleForm(new Apple());
        if ($apple->generateApple()) {
            $this->setFlash('success', 'Apples successfully generated');

            return $this->redirect(Url::toRoute(['apple/get-apples']));
        }
        return $this->redirect(Url::toRoute(['apple/get-apples']));
    }

    public function actionDownApple()
    {
        $id = $this->getInt('id');

        if (!$id) {
            throw new HttpException(404);
        }

        $apple_model = Apple::findOne($id);

        if (!$apple_model) {
            throw new HttpException(404);
        }
        $apple = new AppleForm($apple_model);

        if ($apple->updateStatusApple()) {
            $this->setFlash('success', 'Apples successfully down on the tree');

            return $this->redirect(Url::toRoute(['apple/get-apples']));
        }

        return $this->redirect(Url::toRoute(['apple/get-apples']));
    }

    public function actionEatApple()
    {
        if ($this->isPost()) {
            $params = $this->post();

            if (AppleForm::eatingApple($params['AppleForm'])) {

                $this->setFlash('success', 'Apple  successfully eating');

                return $this->redirect(Url::toRoute(['apple/get-apples']));
            }
            $this->setFlash('error', 'Apple  not possible to eat');
            return $this->redirect(Url::toRoute(['apple/get-apples']));
        }
        $this->setFlash('error', 'Apple  not possible to eat');
        return $this->redirect(Url::toRoute(['apple/get-apples']));
    }
}