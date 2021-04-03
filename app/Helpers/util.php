<?php

/**
 * Get asset full path
 *
 * @param $path
 * @param string $params
 * @return string
 */
function getAssetFullPath($path, $params = '?imageView2/2/w/1000')
{
    if (!Illuminate\Support\Str::is('http*', $path)) {
        if (env('QINIU_ENABLE')) {
            return env('QINIU_DOMAIN') . '/' . $path . $params;
        }

        return asset('storage/' . $path);
    }

    return $path;
}
