<?php

/**
 * @param string $controller
 * @param string $action
 * @param string $prefix
 * @param array $params
 * @return mixed
 */
function router(string $controller, string $action, string $prefix, $params = [])
{
    View::share('controller', $controller);

    $action = s2c($prefix . $action);
    $controller = s2c($controller);

    $namespace = "\\App\\Http\\Controllers\\{$controller}Controller";

    $controller = new $namespace();

    abort_if(!method_exists($controller, $action), 404, __('common.errors.post_404'));

    return app()->call([$controller, $action], request()->all());
}