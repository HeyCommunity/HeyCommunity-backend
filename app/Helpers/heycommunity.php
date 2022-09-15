<?php

function hcRoute($name, $parameters = [], $absolute = true)
{
    $currentRouteName = request()->route()->getName();
    $currentRoutePrefix = \Illuminate\Support\Str::before($currentRouteName, '.');
    $name = $currentRoutePrefix . '.' . $name;

    return route($name, $parameters, $absolute);
}

/**
 * 路由活跃状态
 */
function routeActive($patterns, $activeClassName = 'active', $unactiveClassName = '')
{
    return request()->routeIs($patterns) ? $activeClassName : $unactiveClassName;
}
