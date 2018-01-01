<?php
namespace app\components;

use yii\web\BadRequestHttpException;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class CustomUrlRule extends Object implements UrlRuleInterface {

    public function createUrl($manager, $route, $params) {
        return false;
    }

    public function parseRequest($manager, $request) {
        $pathInfo = $request->getPathInfo();

        // for Bruce
        if ($pathInfo === '') {
            $get = $request->getQueryParams();
            if (!empty($get['r'])) {
                $queryParams = $get['r'];
                $params = [];
                if (strpos($queryParams, 'decrypt/') !== false) {
                    $paramsParts = explode('/', trim($queryParams, ' /'));
                    if (count($paramsParts) !== 2) {
                        throw new BadRequestHttpException(\Yii::t('app', 'Incorrect url.'));
                    }
                    Xed::init(Utils::Settings('ENCRYPT_KEY', 'secret'));
                    $queryParams = Xed::decrypt($paramsParts[1]);
                }
            }
        }
        return false;
    }
}