<?php

/**
 * Get Lorem Image Url.
 *
 * @param  int  $width
 * @param  int  $height
 * @return mixed
 */
function getLoremImageUrl($width = 800, $height = 600)
{
    $baseUrl = 'https://picsum.photos/';
    $url = $baseUrl.$width.'/'.$height;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

    curl_exec($ch);
    $info = curl_getinfo($ch);

    return $info['redirect_url'];
}

/**
 * Save Lorem Image.
 *
 * @param  null  $path
 * @param  int  $width
 * @param  int  $height
 */
function saveLoremImage($path = null, $width = 800, $height = 600)
{
    if (! $path) {
        $path = storage_path('app/uploads/lorem-images/');
    }

    $url = getLoremImageUrl($width, $height);
    $fileName = $path.str_random().'.jpg';

    \Image::make($url)->save($fileName);

    return strstr($fileName, 'uploads/lorem-images');
}
