<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 23/10/18
 * Time: 23:32
 */

namespace Framework\Router;

use Framework\Router;
use Psr\Container\ContainerInterface;

class RouterFactory
{
    public function __invoke(ContainerInterface $container): Router
    {
        return new Router();
    }
}
