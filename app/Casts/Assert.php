<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Assert implements CastsAttributes
{
    protected $qiniuConfig;

    /**
     * construct
     *
     * @param $qiniuConfig
     */
    public function __construct($qiniuConfig = null)
    {
        $this->qiniuConfig = $qiniuConfig;
    }

    /**
     * 将取出的数据进行转换
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        if (Str::is('http*', $value)) {
            return $value;
        } else {
            if (config('system.cdn.enable')) {
                $query = $this->qiniuConfig ? ('?' . $this->qiniuConfig) : null;
                return config('system.cdn.domain') . '/' . $value . $query;
            } else {
                return asset($value);
            }
        }
    }

    /**
     * 转换成将要进行存储的值
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
