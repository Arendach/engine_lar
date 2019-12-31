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
    $namespace = '\\App\\Http\\Controllers\\' . s2c($controller) . 'Controller';

    Config::set('app.controller', "{$namespace}@{$prefix}{$action}");

    View::share('controller', $controller);

    $object = new $namespace();

    abort_if(!method_exists($object, $prefix . $action), 404, __('common.errors.post_404'));

    return app()->call([new $namespace, $prefix . $action,], request()->all());
}