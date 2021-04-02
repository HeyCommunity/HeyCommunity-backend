<?php

/**
 * Is Wechat Browser Request
 */
function isWechatBrowserRequest()
{
    return strpos(\Jenssegers\Agent\Facades\Agent::getUserAgent(), 'MicroMessenger');
}

/**
 * Set Nav Active
 */
function setNavActive($match)
{
    if (is_array($match)) {
        foreach ($match as $item) {
            if (request()->is($item)) {
                return 'active';
            }
        }
    } else {
        return request()->is($match) ? 'active' : '';
    }
}

/**
 * Set Params Active
 */
function setParamActive($paramName, $value)
{
    if (request()->get($paramName) == $value) {
        return 'active';
    }
}

/**
 * Set Disabled
 */
function setDisabled($condition)
{
    if ($condition) {
        return 'disabled';
    }
}

/**
 * Is Super Admin
 */
function isSuperAdmin()
{
    return (Auth::check() && Auth::user()->is_super_admin) ? true : false;
}

/**
 *  String To One Line
 */
function strToOneLine($string)
{
    $string = preg_replace('/\s+/', ' ',$string);
    return $string;
}

/**
 * Get Back To Index Route
 */
function getBrandBackURL()
{
    $routeName = Request::route()->getName();
    $routeRootName = strstr($routeName, '.', true);

    $controllerNames = [
        'news',
        'post',
        'timeline',
        'columnist',
        'column',
        'topic',
        'activity',
    ];

    if (in_array($routeRootName, $controllerNames)) {
        if ($routeRootName == 'column') $routeRootName = 'columnist';

        return route($routeRootName . '.index');
    } else {
        return URL::current();
    }
}

/**
 * Get current subtitle
 */
function getCurrentSubtitle()
{
    $routeName = Request::route()->getName();
    $routeRootName = strstr($routeName, '.', true);

    $controllerNames = [
        'news'          =>  '新闻',
        'post'          =>  '资讯',
        'timeline'      =>  '动态',
        'columnist'     =>  '专栏',
        'column'        =>  '专栏',
        'topic'         =>  '话题',
        'activity'      =>  '活动',
    ];

    if (in_array($routeRootName, array_keys($controllerNames))) {
        return $controllerNames[$routeRootName];
    } else {
        return null;
    }
}

/**
 * Get Form Value For Model Create And Edit
 */
function formValue($object, $key)
{
    if (is_object($object)) {
        return $object->$key;
    } else {
        return null;
    }
}

/**
 * CDN Asset
 */
function cdnAsset($path)
{
    if (!Illuminate\Support\Str::is('http*', $path)) {
        if (env('QINIU_ENABLE')) {
            return env('QINIU_DOMAIN') . '/' . $path . $params;
        }
    }

    return $path;
}

/**
 * Make CDN Asset Path
 */
function makeCdnAssetPath($path, $params = '?imageView2/2/w/1000')
{
    if (!Illuminate\Support\Str::is('http*', $path)) {
        if (env('QINIU_ENABLE')) {
            return env('QINIU_DOMAIN') . '/' . $path . $params;
        }

        return asset($path);
    }

    return $path;
}

/**
 * Get Ip Info To String
 */
function getIpInfoToString($ip)
{
    $district = new \ipip\db\City(resource_path('other/17monipdb/ipipfree.ipdb'));

    try {
        $data = ($district->find($ip, 'CN'));
        return $data[1] . $data[2];
    } catch (Exception $e) {
        return 'unknown';
    }
}

/**
 * Get Jiguang Sms Code
 */
function getJiGuangSmsCode($phone, $msgIdCacheKey = 'captcha-jiguang-msgId', $minutes = 10) {
    $appKey = env('JIGUANG_APPKEY');
    $masterSecret = env('JIGUANG_SECRET');
    $smsTempId = env('JIGUANG_CAPTCHA_TEMPID');
    $signTempId = env('JIGUANG_CAPTCHA_SIGNID');
    $msgIdCacheKey = $msgIdCacheKey . '-' . $phone;

    $client = new \JiGuang\JSMS($appKey, $masterSecret);
    $result = $client->sendCode($phone, $smsTempId, $signTempId);

    if ($result['http_code'] == 200) {
        cache([$msgIdCacheKey => $result['body']['msg_id']], now()->addMinutes($minutes));
    }

    return $result;
}

/**
 * Get Jiguang Sms Code
 */
function checkJiGuangSmsCode($phone, $captcha, $msgIdCacheKey = 'captcha-jiguang-msgId') {
    $appKey = env('JIGUANG_APPKEY');
    $masterSecret = env('JIGUANG_SECRET');
    $msgIdCacheKey = $msgIdCacheKey . '-' . $phone;

    $client = new \JiGuang\JSMS($appKey, $masterSecret);
    $result = $client->checkCode(cache($msgIdCacheKey), $captcha);

    if ($result['http_code'] == 200) {
        \Cache::forget($msgIdCacheKey);

        return true;
    }

    return false;
}

/**
 * Date For Human
 */
function dateForHuman($date, $overDayNum = 7, $format = 'Y-m-d H:i:s') {
    $date = \Illuminate\Support\Carbon::parse($date);
    $diffDate = $date->copy()->addDays($overDayNum);

    if ($diffDate > now()) {
        return $date->diffForHumans();
    }

    return $date->format($format);
}

/**
 * Set UiKit Notice
 */
function setUkNotice($message, $status = 'default', $timeout = 3000, $position = 'top-right') {
    session()->flash('uk-notice', [
        'message'   =>  $message,
        'status'    =>  $status,
        'timeout'   =>  $timeout,
        'position'  =>  $position,
    ]);
}

/**
 * Get UiKit Notice
 */
function getUkNotice() {
    return session('uk-notice');
}
