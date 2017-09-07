<?php
namespace warsztatweb\seo;

use yii;
use yii\helpers\Url;
use yii\web\ErrorHandler;
use warsztatweb\seo\models\SeoRedirects;

class Redirect extends ErrorHandler {

    public function handleException($exception)
    {
        $redirectModel = SeoRedirects::find()
            ->where(['old_url' => str_replace(Yii::$app->request->baseUrl,"",Yii::$app->request->url)])
            ->asArray()
            ->one();
        if(!empty($redirectModel)) {
            $redirectStatus = ($redirectModel['status'] == 302) ? 302 : 301;
            header("Location: " . $redirectModel['new_url'], true, $redirectStatus);
            exit;
        }

        parent::handleException($exception);
    }

}