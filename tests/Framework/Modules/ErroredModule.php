<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 09/10/18
 * Time: 22:13
 */

namespace Tests\Framework\Modules;

class ErroredModule
{
    public function __construct(\Framework\Router $router)
    {
        $router->get('/demo', function () {
            return new \stdClass();
        }, 'demo');
    }
}
