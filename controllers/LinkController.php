<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Link;

class LinkController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShorten()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $url = Yii::$app->request->post('url');
                
        // Валидация URL
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return ['error' => 'Некорректный URL'];
        }

        // Проверка доступности URL
        $headers = @get_headers($url);
        if (!$headers || strpos($headers[0], '200') === false) {
            return ['error' => 'Данный URL не доступен'];
        }

        // Генерация короткой ссылки
        $link = Link::findOne(['url' => $url]);
        if ($link) {
            return [
                'short_url' => Yii::$app->request->hostInfo . '/' . $link->short_url,
            ];
        }
        else {
            $link = new Link();
            $link->url = $url;
            $link->short_url = substr(md5($url), 0, 6);
            if ($link->save()) {
                return [
                    'short_url' => Yii::$app->request->hostInfo . '/' . $link->short_url,
                ];
            }
            else{
                return [
                    'errors' => 'Ошибка сохранения ссылки',
                ];
            }
        }
    }

}
