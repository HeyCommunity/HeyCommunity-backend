<?php

function getImageFakerUrl($width = 800, $height = 600, $category = 'default', $index = null)
{
    // TODO
    $category = 'default';
    if ($index === null || $index > 10) {
        $index = random_int(1, 10);
    }

    $urlBase = 'http://faker-images.protobia.net/';

    return $urlBase.$category.'/'.$index.'.jpg'."?imageView2/1/w/$width/h/$height";
}
