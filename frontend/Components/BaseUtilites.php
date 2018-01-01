<?php

namespace app\components;

use app\models\Country;
use DateTime;
use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Request;

class BaseUtilites {

    public static function getOperator($qryString) {
        switch ($qryString) {
            case strpos($qryString, '>=') === 0:
                $operator = '>=';
                break;
            case strpos($qryString, '>') === 0:
                $operator = '>';
                break;
            case strpos($qryString, '<=') === 0:
                $operator = '<=';
                break;
            case strpos($qryString, '<') === 0:
                $operator = '<';
                break;
            default:
                $operator = 'like';
                break;
        }
        return $operator;
    }

    /**
     * @return int
     */
    public static function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    /**
     *  Get new Width and Height with aspect ratio from existing image file
     *
     * @param string $imageFile - image filename
     * @param int $needW - new Width
     * @param int $needH - new Height
     *
     * @return array($width, $height)
     */
    static function getNewImageSize($imageFile, $needW, $needH) {
        if (is_file($imageFile)) {
            list($width, $height) = getimagesize($imageFile);
            return self::calcNewImageSize($width, $height, $needW, $needH);
        }
        return array((int) $needW, (int) $needH);
    }

    /**
     * Resize source image to target image wits aspect ratio
     *
     * @param string $source - source filename
     * @param string $target - target filename
     * @param int $tW - new Width
     * @param int $tH - new Height
     *
     *
     */
    static function makeResize($source, $target, $tW, $tH, $square = false) {
        // Get new sizes
        list($width, $height) = getimagesize($source);
        list($newwidth, $newheight) = self::calcNewImageSize($width, $height, $tW, $tH);

        // Get image type
        $imgType = exif_imagetype($source);

        // Load
        switch ($imgType) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($source);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($source);
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($source);
                break;
        }

        $posX = 0;
        $posY = 0;

        if ($square) {
            $new_image = imagecreatetruecolor($tW, $tH);

            if ($newwidth < $newheight) {
                $posX = ($tW / 2) - ($newwidth / 2);
            } else if ($newwidth > $newheight) {
                $posY = ($tH / 2) - ($newheight / 2);
            }
        } else {
            $new_image = imagecreatetruecolor($newwidth, $newheight);
        }

        $background = imagecolorallocate($new_image, 255, 255, 255);
        imagefilledrectangle($new_image, 0, 0, $tW, $tH, $background);

        imagecopyresampled($new_image, $source, $posX, $posY, 0, 0, $newwidth, $newheight, $width, $height);

        // Output
        $oldumask = umask(0);
        if (is_file($target)) {
            unlink($target);
        }
        switch ($imgType) {
            case IMAGETYPE_JPEG:
                $ok = imagejpeg($new_image, $target, 100);
                break;
            case IMAGETYPE_PNG:
                $ok = imagepng($new_image, $target);
                break;
            case IMAGETYPE_GIF:
                $ok = imagegif($new_image, $target);
                break;
        }
        umask($oldumask);
        imagedestroy($new_image);
        imagedestroy($source);

        return $ok;
    }

    /**
     *  Calc new Width and Height with aspect ratio from existing dimentions
     *
     * @param int $origW - exists Width
     * @param int $origH - exists Height
     * @param int $needW - new Width
     * @param int $needH - new Height
     *
     * @return array($width, $height)
     */
    static function calcNewImageSize($origW, $origH, $needW, $needH) {
        if ($origW > $origH) {
            $percent = $origH / $origW;
            if ($needW > $origW) {
                $newwidth = $origW;
            } else {
                $newwidth = $needW;
            }
            $newheight = $newwidth * $percent;
            if ($newheight > $needH) {
                $newheight = $needH;
                $newwidth = round($needH * ($origW / $origH));
            }
        } else {
            $percent = $origW / $origH;
            if ($needH > $origH) {
                $newheight = $origH;
            } else {
                $newheight = $needH;
            }
            $newwidth = $newheight * $percent;
            if ($newwidth > $needW) {
                $newwidth = $needW;
                $newheight = round($needW * ($origH / $origW));
            }
        }

        return array((int) $newwidth, (int) $newheight);
    }

    /**
     *
     * @param array $route
     */
    public static function getSessionFilterUrl($route) {
        $route = (array) $route;
        $sessionParam = self::addLeadingSymbol($route[0] . '/' . $route['id'] . '/filter');

        $url = '';
        $session = Yii::$app->getSession();
        if ($session->get($sessionParam)) {
            $url .= $session->get($sessionParam);
        } else {
            $url .= Url::toRoute($route);
        }
        return $url;
    }

    /**
     *
     * @param string $sessionBackUrlParam
     * @param Request $request
     * @param Controller $controller
     * @param array $ignored
     * @return string
     */
    public static function getSessionBackUrl($sessionBackUrlParam, $request, $controller, $ignored = []) {
        $controllerAction = $controller->getRoute();
        $refferer = $request->getReferrer();


        $ignoredPos = false;
        foreach ($ignored as $ignor) {
            $ignoredPos = strpos($refferer, $ignor);
            if ($ignoredPos !== false) {
                break;
            }
        }
        if (
                !empty($refferer) &&
                !$request->getIsAjax() &&
                !strpos($refferer, $controllerAction) &&
                !(in_array($controllerAction, $ignored) || $ignoredPos !== false)
        ) {
            Yii::$app->getSession()->set($sessionBackUrlParam, $refferer);
        }
        return Yii::$app->getSession()->get($sessionBackUrlParam, $request->getBaseUrl());
    }

    /**
     *
     * @param string $str
     * @param string $symbol
     * @return string
     */
    public static function addLeadingSymbol($str, $symbol = '/') {
        if (strpos($str, $symbol) !== 0) {
            $str = $symbol . $str;
        }
        return $str;
    }

    /**
     * render yes and ro
     *
     * @param $int
     * @return string
     */
    public static function renderStatus($int) {
        if ($int) {
            return Html::tag('span', Yii::t('app', 'On'), ['style' => 'color: green;']);
        }
        return Html::tag('span', Yii::t('app', 'Off'), ['style' => 'color: red;']);
    }

    /**
     * render yes and ro
     *
     * @param $int
     * @return string
     */
    public static function renderYesNo($int, $colorify = true) {
        if ($int) {
            return Html::tag('span', Yii::t('app', 'Yes'), ($colorify) ? ['style' => 'color: green;'] : []);
        }
        return Html::tag('span', Yii::t('app', 'No'), ($colorify) ? ['style' => 'color: red;'] : []);
    }

    /**
     * render Active and Inactive
     *
     * @param $int
     * @return string
     */
    public static function renderActiveInactive($int, $colorify = true) {
        if ($int) {
            return Html::tag('span', Yii::t('app', 'Active'), ($colorify) ? ['style' => 'color: green;'] : []);
        }
        return Html::tag('span', Yii::t('app', 'Inactive'), ($colorify) ? ['style' => 'color: red;'] : []);
    }

    /**
     * render status of tram
     *
     * @param $int
     * @return string
     */
    public static function renderClosedTeamStatus($int) {
        if ($int) {
            return Html::tag('span', Yii::t('app', 'Closed'), ['style' => 'color: red;']);
        }
        return Html::tag('span', Yii::t('app', 'Active'), ['style' => 'color: green;']);
    }

    /**
     *
     * @return array
     */
    public static function getActiveOptions() {
        return [
            1 => Yii::t('app', 'Yes'),
            0 => Yii::t('app', 'No'),
        ];
    }

    public static function renderLinkText($text) {
//			$text = htmlentities($text);
        $text = preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
        $text = preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
        $text = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
        $text = str_replace("\t", "&emsp;", $text);
        return($text);
    }

    public static function renderDescription($text) {
        /*
          $text = preg_replace('/<p[^>]*?><br>[\s|\n]*<\/p>/', '<p></p>', $text);
          $text = preg_replace('/<p(?:\s[^>]*?)?>/', '', $text);
          $text = str_replace('</p>', '<br>', $text);
         *
         */
        return $text;
    }

    /**
     * Create Path
     *
     * @param $path
     * @param int $mode
     * @param bool $recursive
     * @return bool
     * @throws Exception
     */
    public static function mkpath($path, $mode = 0777, $recursive = true) {
        return FileHelper::createDirectory($path, $mode, $recursive);
    }

    public static function renderActiveNavMenu($item) {
        if ($item == Yii::$app->request->getUrl() && $item != '/') {
            return 'active';
        }

        return false;
    }

    public static function pagerParams($params) {
        if (isset($params['page']) && (int) $params['page'] > 0) {
            return $params['page'] - 1;
        }

        return 0;
    }

    /**
     * Converts a human readable file size value to a number of bytes that it
     * represents. Supports the following modifiers: K, M, G and T.
     * Invalid input is returned unchanged.
     *
     * Example:
     * <code>
     * $config->convertToByte(10);          // 10
     * $config->convertToByte('10b');       // 10
     * $config->convertToByte('10k');       // 10240
     * $config->convertToByte('10K');       // 10240
     * $config->convertToByte('10kb');      // 10240
     * $config->convertToByte('10Kb');      // 10240
     * // and even
     * $config->convertToByte('   10 KB '); // 10240
     * </code>
     *
     * @param number|string $value
     * @return number
     */
    public static function convertToByte($value) {
        return preg_replace_callback('/^\s*(\d+)\s*(?:([kmgt]?)b?)?\s*$/i', function ($m) {
            switch (strtolower($m[2])) {
                case 't': $m[1] *= 1024;
                case 'g': $m[1] *= 1024;
                case 'm': $m[1] *= 1024;
                case 'k': $m[1] *= 1024;
            }
            return $m[1];
        }, $value);
    }

    /**
     * @param $text - Text
     * @param $countlength - count symbol in text
     * @param $more_link - more link
     * @param string $line_symbol
     * @param string $sep
     *
     * @return string
     */
    public static function maxLengthText($text, $countlength, $more_link = '', $line_symbol = '...', $sep = ' ') {
        $text_crop_length = $text;
        if (strlen($text) > $countlength) {
            $text = mb_substr($text, 0, $countlength, 'UTF-8');
            $words = explode($sep, $text);
            array_pop($words);
            $text = join($sep, $words);
        }

        $moreLink = '';
        if (strlen($text_crop_length) > $countlength) {
            $moreLink = $line_symbol;

            if (!empty($more_link)) {
                $moreLink = ' ' . $more_link;
            }
        }

        return $text . $moreLink;
    }

    /**
     * @param array | string $action
     * @return bool
     */
    public static function isAction($action) {
        if (is_array($action)) {
            return in_array(Yii::$app->controller->action->id, $action);
        }
        return Yii::$app->controller->action->id === $action;
    }

    /**
     * first argument controller name second argument action name or
     * array of action names
     *
     * @param $controller
     * @param $action
     * @return bool
     */
    public static function isController($controller, $action = false) {
        return Yii::$app->controller->id === $controller && ($action === false || self::isAction($action));
    }

    /**
     * @param $modelsForValidation
     * @param $models
     * @param $get
     * @return array|bool
     */
    public static function multipleFormValidate($modelsForValidation, $models, $get) {
        extract($models);
        $validatedModels = [];
        $load = false;
        foreach ($modelsForValidation as $validate_model) {
            if ($$validate_model->load($get)) {
                $load = true;
            }
        }

        if ($load) {
            foreach ($modelsForValidation as $validate_model) {
                if (empty($get[$$validate_model->formName()])) {

                }
                $attributeFields = array_keys($get[$$validate_model->formName()]);
                if ($$validate_model->validate($attributeFields)) {
                    $validatedModels[] = $validate_model;
                }
            }
            //all models valid
            $difArr = array_diff($modelsForValidation, $validatedModels);
            $canSave = (empty($difArr)) ? true : false;
            if ($canSave) {
                $errors = [];
                foreach ($validatedModels as $validate_model) {
                    if ($validate_model == 'IATS') {
                        if ($$validate_model->status == '1') {
                            $$validate_model->status = 'Ready to Submit';
                        }
                        if ($$validate_model->status == '0') {
                            $$validate_model->status = 'Unverified';
                        }
                    }
                    if (!$$validate_model->save(false)) {
                        $errors[] = $$validate_model->getErrors();
                    }
                }
                if (empty($errors)) {
                    return true;
                }
            }
        }
        return compact($modelsForValidation);
    }

    /**
     * format to project date
     * @param $date
     * @return string
     */
    public static function toProjectDate($date) {
        if ($date == '0000-00-00' || $date == '') {
            return '';
        }

        if ($date instanceof DateTime) {
            return $date->format(Utils::Settings('PROJECT_DATE_FORMAT', ''));
        }

        $dateTime = new DateTime($date);
        return $dateTime->format(Utils::Settings('PROJECT_DATE_FORMAT', ''));
    }

    /**
     * format to project date
     * @param $date
     * @return string
     */
    public static function toProjectDateTime($date) {
        if ($date == '0000-00-00') {
            return '';
        }

        if ($date instanceof DateTime) {
            return $date->format(Utils::Settings('PROJECT_DATETIME_FORMAT', ''));
        }

        $dateTime = new DateTime($date);
        return $dateTime->format(Utils::Settings('PROJECT_DATETIME_FORMAT', ''));
    }

    /**
     * Insert into array after chosen value if couldn't find value just add to array
     *
     *
     * @param $array
     * @param $element
     * @param $insertElement
     * @return array
     */
    public static function insertBeforeArrayElement($array, $element, $insertElement) {
        $position = array_search($element, $array);
        if ($position !== false) {
            if ($position == 0) {
                $position = 0;
            }
            array_splice($array, $position, 0, [$insertElement]);
        } else {
            $array[] = $insertElement;
        }
        return $array;
    }

    /**
     * @param $array
     * @param $key
     * @param $val
     * @return array
     */
    public static function arrayToDropdown($array, $key, $val) {
        $result = [];
        foreach ($array as $element) {
            $result[$element[$key]] = $element[$val];
        }
        return $result;
    }

    /**
     *  returns true if iphone detected
     */
    public static function isIphone() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false)) {
            return true;
        }
        return false;
    }

    /**
     *  returns true if iphone detected
     */
    public static function isIpad() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false)) {
            return true;
        }
        return false;
    }

    /**
     *  returns true if android detected
     */
    public static function isAndroid() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && (strstr($_SERVER['HTTP_USER_AGENT'], 'Android') !== false)) {
            return true;
        }
        return false;
    }

    public static function isSwipetrack() {
        return strstr($_SERVER['HTTP_USER_AGENT'], 'STBrowser') !== false;
    }

    public static function isDesktop() {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {

            $isSwipeTrack = (strstr($_SERVER['HTTP_USER_AGENT'], 'STBrowser') !== false);
            $isIPad = Utils::isIpad();
            $isIPhone = Utils::isIphone();
            $isAndroid = Utils::isAndroid();

            if ($isSwipeTrack || $isIPad || $isIPhone || $isAndroid) {
                return false;
            }
        }
        return true;
    }

    /**
     * get db name from config
     */
    public static function getDsnAttribute($name, $dsn) {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return '';
        }
    }

    /**
     * @param $shortName
     * @return string
     */
    public static function fullCountryName($shortName) {
        if (array_key_exists($shortName, Country::CountryList())) {
            return Country::CountryList()[$shortName];
        }
        return '';
    }

    public static function NormalizePhone($phone) {
        return str_replace('-', '', str_replace('.', '', str_replace('(', '', str_replace(')', '', $phone))));
    }

    public static function Settings($param_name, $default = false, $config_name = 'params') {
        $ret = $default;
        //$module = Yii::$app->getModule($config_name);
        switch ($config_name) {
            case 'params':
                if (isset(Yii::$app->params))
                    $module = Yii::$app->params;
                break;
        }
        if (!empty($module)) {
            if(is_array($param_name)) {
                $ret = self::findMultiDimenshionParam($param_name, $module);
                $ret = ($ret == false) ? $default : $ret;
            }
            elseif (isset($module[$param_name])) {
                $ret = $module[$param_name];
            }
        }
        return $ret;
    }

    public static function findMultiDimenshionParam($params, $module) {
        foreach($params as $param) {
            if(isset($module[$param])) {
                $module = $module[$param];
            }
            else{
                return false;
            }
        }
        return $module;
    }

    public static function uuid($prefix = '') {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr($chars, 0, 8) . '-';
        $uuid .= substr($chars, 8, 4) . '-';
        $uuid .= substr($chars, 12, 4) . '-';
        $uuid .= substr($chars, 16, 4) . '-';
        $uuid .= substr($chars, 20, 12);
        return $prefix . $uuid;
    }

    /**
     * month list start from zero
     * @return array
     */
    public static function getMonthList() {
        return array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
    }

    /**
     * @param $months
     * @return mixed
     */
    public static function toMonthList($months) {
        foreach ($months as &$month) {
            $dateObj = DateTime::createFromFormat('!m', $month);
            $month = ltrim($month, '0') . '-' . $dateObj->format('M'); // March
        }
        return $months;
    }


    /**
     * @param $string
     * @return bool
     */
    public static function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }


    /**
     * return null if not set
     * return value if set
     *
     * @param $param
     * @param $param
     * @return null
     */
    public static function controllerParam($param) {
        $result = '';
        if(isset(Yii::$app->controller->param[$param]) && !empty(Yii::$app->controller->param[$param])){
            $result = Yii::$app->controller->param[$param];
        }
        return $result;
    }


    /**
     * @return bool
     */
    public static function isAdmin() {
        return Yii::$app->user->identity->AccessLevel === 1;
    }


    /**
     * @return bool
     */
    public static function isCountryAdmin() {
        return Yii::$app->user->identity->AccessLevel === 2;
    }

    /**
     * @return bool
     */
    public static function isOfficeAdmin() {
        return Yii::$app->user->identity->AccessLevel === 3;
    }


    /**
     * @return bool
     */
    public static function isUser() {
        return Yii::$app->user->identity->AccessLevel === 5;
    }

    /**
     * @return bool
     */
    public static function isPfuUser() {
        return Yii::$app->user->identity->AccessLevel === 4;
    }

    public static function setLanguage($language_code) {
    	switch ($language_code) {
			case 'us': $language_code = 'en-US'; break;
			case 'fr': $language_code = 'fr-FR'; break;
		}
		Yii::$app->session->set('language_code', $language_code);
    	Yii::$app->language = $language_code;
	}
}
