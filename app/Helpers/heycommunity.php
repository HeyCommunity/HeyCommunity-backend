<?php

/**
 * 路由活跃状态
 */
function routeActive($patterns, $activeClassName = 'active', $unactiveClassName = '')
{
    return request()->routeIs($patterns) ? $activeClassName : $unactiveClassName;
}
