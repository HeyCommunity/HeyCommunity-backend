<?php

/**
 * Get asset full path.
 *
 * @param $path
 * @param  string  $params
 * @return string
 */
function getAssetFullPath($path, $params = null)
{
    if (! Illuminate\Support\Str::is('http*', $path)) {
        if (config('system.cdn.enable')) {
            return config('system.cdn.domain').'/'.$path.$params;
        }

        return asset($path);
    }

    return $path;
}

/**
 * 获取图片的完整路径.
 *
 * @param $path
 * @param  string  $params
 * @return string
 */
function getImageFullPath($path, $params = '?imageView2/2/w/1000')
{
    return getAssetFullPath($path, $params);
}

/**
 * 获取视频的完整路径.
 *
 * @param $path
 * @return string
 */
function getVideoFullPath($path)
{
    return getAssetFullPath($path);
}
