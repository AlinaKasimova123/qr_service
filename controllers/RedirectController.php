<?php

namespace app\controllers;

use Yii;
use app\models\Link;
use app\models\User;

class RedirectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRedirect($short_url)
    {
        $link = Link::findOne(['short_url' => $short_url]);
        if ($link) {
            $link->clicks++;
            $link->save();

            // Логирование IP
            $user = new User();
            $user->link_id = $link->link_id;
            $user->ip_address = Yii::$app->request->userIP;
            $user->save();

            return $this->redirect($link->url);
        }

        throw new \yii\web\NotFoundHttpException('Ссылка не найдена');
    }
}
