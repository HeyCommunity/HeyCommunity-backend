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
        if (config('system.cdn.enable')) {
            return config('system.cdn.domain') . '/' . $path . $params;
        }

        return asset($path);
    }

    return $path;
}
